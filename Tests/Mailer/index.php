<?php

use Webiny\Component\Mailer\Email;
use Webiny\Component\Mailer\Mailer;
use Webiny\Component\Storage\Driver\Local\Local;
use Webiny\Component\Storage\Storage;

require_once 'setup.php';

class MailerTest
{
    use \Webiny\Component\Mailer\MailerTrait;

    public function run()
    {
        Mailer::setConfig(realpath(__DIR__ . '/Config.yaml'));


        $mailerName = 'Mandrill';
        $mailer = $this->mailer($mailerName);

        // let's build our message
        $decorators = [
            'pavel910@gmail.com' => [
                'name' => 'Pavel',
                'mailer' => $mailerName
            ]
        ];

        $body = 'webiny-test';
        $body = 'Hello *|name|*!!<br>This is a message sent by *|mailer|*.';
        $msg = $mailer->getMessage()->setBody($body);
        $msg->setFrom(new Email('pavel@kompare.hr'));
        $msg->setReplyTo(new Email('pavel@kompare.hr'))
            ->setSubject('Hello from *|mailer|*')
            ->setTo(new Email('pavel910@gmail.com', 'Pavel'));

        $storage = new Storage(new Local(__DIR__));

        $attachment = new \Webiny\Component\Storage\File\LocalFile('Ponuda.pdf', $storage);
        $msg->addAttachment($attachment, 'Ponuda 123', 'application/pdf');

        // send it
        $res = $mailer->setDecorators($decorators)->send($msg, $failures);

        die("SUCCESS: " . $res);
    }
}

$st = new MailerTest();
$st->run();