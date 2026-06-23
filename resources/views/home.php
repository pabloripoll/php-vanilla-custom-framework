<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP HTML</title>
    <link rel="icon" type="image/x-icon" href="https://www.php.net/images/logos/php-icon-white.gif">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PHP HTML">
    <link rel="stylesheet" href="<?= assets('css/styles.css') ?>">
</head>
<body>
    <?= includes('components.logo') ?>
    <header>
        <h1>PLATFORM <span>API REST</span> <?= $php_version ?? ''; ?></h1>
    </header>
    <p>Container is running succesfully and serving plain <code>index.php</code> script with <span>HTML5</span> on <code>./public</code> folder.</p>
    <p>Database container status: <?= $dbstatus_message ?? ''; ?>.</p>
    <br>
    <h2>Check services by sending a request to API:</h2>
    <p><span>Postgre</span>: <a href="#" id="btn-pgsql" title="Click to check Postgre connection">Connect Postgre</a> <div id="pgsql-status"></div></p>
    <p><span>MySQL</span>: <a href="#" id="btn-mysql" title="Click to check MySQL connection">Connect MySQL</a> <div id="mysql-status"></div></p>
    <p><span>Mongo</span>: <a href="#" id="btn-mongo" title="Click to check Mongo connection">Connect Mongo</a> <div id="mongo-status"></div></p>
    <p><span>Redis</span>: <a href="#" id="btn-redis" title="Click to check Redis connection">Connect Redis</a> <div id="redis-status"></div></p>
    <p><span>MailHog</span>: <a href="#" id="btn-email" title="Click to send an email">Send EMAIL</a> <div id="email-status"></div></p>
    <p><span>RabbitMQ</span>: <a href="#" id="btn-queue" title="Click to push a message to queue">QUEUE Email</a> <div id="queue-status"></div></p>
    <script src="<?= assets('js/home.js') ?>"></script>
</body>
</html>