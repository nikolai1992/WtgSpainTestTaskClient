<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class WTGApiServices
{
    public function login(string $email, string $password): bool
    {
        $response = $this->prepareRequest()->post(
            '{+domain}/api/login',
            [
                'email' => $email,
                'password' => $password,
            ]
        );
        if ($response->successful()) {
            $result = $response->object();
            session()->put('auth_token', $result->data->token);
            return true;
        }
        return false;
    }

    public function registerUser(
        string $name,
        string $email,
        string $password,
        string $passwordConfirm
    ): bool
    {
        $response = $this->prepareRequest()->post(
            '{+domain}/api/register',
            [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'password_confirmation' => $passwordConfirm,
            ]
        );
        if ($response->successful()) {
            return true;
        }
        return false;
    }

    public function getTasks()
    {
        $token = session()->get('auth_token');
        $response = $this->prepareRequest()
            ->withToken($token)
            ->get('{+domain}/api/tasks');
        if ($response->successful()) {

            return $response->object()->data;
        }
    }

    public function showTask(int $taskId)
    {
        $token = session()->get('auth_token');
        $response = $this->prepareRequest()
            ->withToken($token)
            ->get('{+domain}/api/tasks/' . $taskId);
        if ($response->successful()) {

            return $response->object()->data;
        }
    }

    public function logout(): bool
    {
        $token = session()->get('auth_token');
        $response = $this->prepareRequest()
            ->withToken($token)
            ->post(
            '{+domain}/api/logout', [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'Accept' => 'application/json',
                ],
            ]
        );
        if ($response->successful()) {
            $result = $response->object();
            if (!isset($result->data->error)) {
                session()->forget('auth_token');
                return true;
            }
        }
        return false;
    }
    public function updateTask(int $taskId, array $data)
    {
        $token = session()->get('auth_token');
        $response = $this->prepareRequest()
            ->withToken($token)
            ->put('{+domain}/api/tasks/' . $taskId, $data);
        if ($response->successful()) {

            return $response->object()->data;
        }
    }
    public function storeTask(array $data)
    {
        $token = session()->get('auth_token');
        $response = $this->prepareRequest()
            ->withToken($token)
            ->post('{+domain}/api/tasks/', $data);
        if ($response->successful()) {

            return $response->object()->data;
        }
    }
    public function deleteTask(int $id)
    {
        $token = session()->get('auth_token');
        $response = $this->prepareRequest()
            ->withToken($token)
            ->delete('{+domain}/api/tasks/' . $id);
        if ($response->successful()) {
            return true;
        }
    }

    public function getTeams()
    {
        $token = session()->get('auth_token');
        $response = $this->prepareRequest()
            ->withToken($token)
            ->get('{+domain}/api/teams');
        if ($response->successful()) {
            return $response->object()->data;
        }
    }
    public function storeTeam(array $data)
    {
        $token = session()->get('auth_token');
        $response = $this->prepareRequest()
            ->withToken($token)
            ->post('{+domain}/api/teams/', $data);
        if ($response->successful()) {

            return $response->object()->data;
        }
    }

    public function addMemberIntoTeam(int $teamId, array $data)
    {
        $token = session()->get('auth_token');
        $response = $this->prepareRequest()
            ->withToken($token)
            ->post('{+domain}/api/teams/' . $teamId . '/users', $data);
        if ($response->successful()) {
            return $response->object()->data;
        }
    }

    public function removeMemberFromTeam(int $teamId, int $userId)
    {
        $token = session()->get('auth_token');
        $response = $this->prepareRequest()
            ->withToken($token)
            ->delete('{+domain}/api/teams/' . $teamId . '/users/' . $userId);
        if ($response->successful()) {
            return true;
        }
    }

    public function getAllMembers()
    {
        $token = session()->get('auth_token');
        $response = $this->prepareRequest()
            ->withToken($token)
            ->get('{+domain}/api/users');

        if ($response->successful()) {

            return $response->object()->data;
        }
    }

    private function prepareRequest(): PendingRequest
    {
        return Http::withUrlParameters([
            'domain' => config('app.wtgtestapiurl'),
        ]);
    }
}
