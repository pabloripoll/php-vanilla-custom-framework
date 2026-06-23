<?php

namespace App\Controller;

use Exception;
use Config\Request;
use DB\Primary;
use DB\Secondary;
use DB\Doc;
use DB\Memo;
use App\Service\Mailer;
use App\Service\TaskQueue;

class ApiController
{
    /**
     * POST /api/test/postgre
     */
    public function testPostgre(Request $request)
    {
        try {
            Primary::conn();

            return response()->json([
                'status' => true,
                'message' => 'Postgre successfully connected.'
            ]);

        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Postgre connection error.',
                    'error' => $e->getMessage()
                ],
                500
            );
        }
    }

    /**
     * POST /api/test/mysql
     */
    public function testMysql(Request $request)
    {
        try {
            Secondary::conn();

            return response()->json([
                'status' => true,
                'message' => 'Mysql successfully connected.'
            ]);

        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Mysql connection error.',
                    'error' => $e->getMessage()
                ],
                500
            );
        }
    }

    /**
     * POST /api/test/mongodb
     */
    public function testMongodb(Request $request)
    {
        try {
            Doc::conn();

            return response()->json([
                'status' => true,
                'message' => 'MongoDB successfully connected.'
            ]);

        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' =>  'MongoDB connection error.',
                    'error' => $e->getMessage()
                ],
                500
            );
        }
    }

    /**
     * POST /api/test/redis
     */
    public function testRedis(Request $request)
    {
        try {
            Memo::conn();

            return response()->json([
                'status' => true,
                'message' => 'Redis successfully connected.'
            ]);

        } catch (Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'message' =>  'Redis connection error.',
                    'error' => $e->getMessage()
                ],
                500
            );
        }
    }

    /**
     * POST /api/test/testMail
     * Uses PHPMailer to send via MailHog (local SMTP on port 1025 by default).
     */
    public function testMail(Request $request)
    {
        try {
            $mailer = new Mailer;
            $payload = [
                'to' => 'admin@example.com',
                'subject' => 'Testing email from platform installation',
                'body' => 'This is a testing email from platform install home page, sent at ' . date('Y-m-d H:i:s'),
                'from' => 'dev@example.com',
                'from_name' => 'Dev user',
            ];
            $email = $mailer->send($payload);

            if (isset($email->message)) {
                return response()->json(['status' => $email->status, 'message' => $email->message]);
            }

            return response()->json($email, 500);

        } catch (\Throwable $e) {
            return response()->json(['status' => false, 'message' => 'Send failed: ' . $e->getMessage()], 500);
        }
    }

    /**
     * POST /api/test/queue
     * Publishes JSON payload to a RabbitMQ queue (php-amqplib required).
     */
    public function testQueue(Request $request)
    {
        $task = 'installation-test-email';
        $payload = [
            'to' => 'admin@example.com',
            'subject' => 'Testing email from broker installation',
            'body' => 'This is a testing email from broker queued message, sent at ' . date('Y-m-d H:i:s'),
            'from' => 'broker@example.com',
            'from_name' => 'Broker',
        ];

        try {
            $queue = (new TaskQueue)->set($task, $payload);

            if ($queue->status === false) {
                return response()->json(['status' => false, 'message' => 'Queue error: ' . $queue->error], 500);
            }

            return response()->json(['status' => $queue->status, 'message' => 'Message queued.']);

        } catch (\Throwable $e) {
            return response()->json(['status' => false, 'message' => 'Message queue failed: ' . $e->getMessage()], 500);
        }
    }
}
