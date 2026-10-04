<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserPasswords extends Migration
{
    public function up()
    {
        // The TFA3 schema is imported first. Existing accounts keep their IDs and data.
        $initialPassword = (string) env('TFA4_INITIAL_PASSWORD', 'LokalCart2026!');
        if (strlen($initialPassword) < 8 || strlen($initialPassword) > 72 || str_contains($initialPassword, "\0")) {
            throw new \RuntimeException('TFA4_INITIAL_PASSWORD must be 8–72 bytes.');
        }

        if (! $this->db->fieldExists('password', 'users')) {
            $this->forge->addColumn('users', [
                'password' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            ]);
        }

        // A unique salt is generated for every record. Never overwrite an existing hash.
        $users = $this->db->table('users')->select('id')->groupStart()
            ->where('password', null)->orWhere('password', '')->groupEnd()->get()->getResultArray();
        foreach ($users as $user) {
            $this->db->table('users')->where('id', $user['id'])->update([
                'password' => password_hash($initialPassword, PASSWORD_DEFAULT),
            ]);
        }

        if (! $this->forge->modifyColumn('users', [
            'password' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
        ])) {
            throw new \RuntimeException('Could not finalize the users.password column.');
        }
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'password');
    }
}
