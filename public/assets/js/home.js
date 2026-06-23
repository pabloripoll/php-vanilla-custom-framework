
document.addEventListener('DOMContentLoaded', function () {
    const pgsqlBtn = document.getElementById('btn-pgsql');
    const pgsqlStatus = document.getElementById('pgsql-status');

    const mysqlBtn = document.getElementById('btn-mysql');
    const mysqlStatus = document.getElementById('mysql-status');

    const mongoBtn = document.getElementById('btn-mongo');
    const mongoStatus = document.getElementById('mongo-status');

    const redisBtn = document.getElementById('btn-redis');
    const redisStatus = document.getElementById('redis-status');

    const emailBtn = document.getElementById('btn-email');
    const emailStatus = document.getElementById('email-status');

    const queueBtn = document.getElementById('btn-queue');
    const queueStatus = document.getElementById('queue-status');

    const colorDanger = '#FF6467';
    const colorWarning = '#E9C008';
    const colorSuccess = '#9AE630';


    function setStatus(el, text, status = null) {
        if (!el) return;
        el.textContent = text;
        el.classList.remove('status', 'error');
        if (status === true) el.classList.add('status');
        if (status === false) el.classList.add('error');
    }

    // Postgre
    if (pgsqlBtn) {
        pgsqlBtn.addEventListener('click', async function (e) {
            e.preventDefault();
            setStatus(pgsqlStatus, 'Connecting...', null);
            try {
                const res = await fetch('/api/test/postgre', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: null,
                    credentials: 'same-origin'
                });
                const json = await res.json().catch(() => null);
                if (res.ok && json !== null) {
                    if (json.status === true) {
                        setStatus(pgsqlStatus, json?.message ?? 'Connected :)', true);
                        pgsqlStatus.style.color = colorSuccess;
                        return
                    }
                    setStatus(pgsqlStatus, json?.error ?? 'Error :(', true);
                    pgsqlStatus.style.color = colorDanger;
                } else {
                    setStatus(pgsqlStatus, json?.message ?? 'Failed :/', false);
                    pgsqlStatus.style.color = colorDanger;
                }
            } catch (err) {
                setStatus(pgsqlStatus, 'Network error', false);
                pgsqlStatus.style.color = colorWarning;
            }
        });
    }

    // MySQL/MariaDB
    if (mysqlBtn) {
        mysqlBtn.addEventListener('click', async function (e) {
            e.preventDefault();
            setStatus(mysqlStatus, 'Connecting...', null);
            try {
                const res = await fetch('/api/test/mysql', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: null,
                    credentials: 'same-origin'
                });
                const json = await res.json().catch(() => null)
                if (res.ok && json !== null) {
                    if (json.status === true) {
                        setStatus(mysqlStatus, json?.message ?? 'Connected :)', true);
                        mysqlStatus.style.color = colorSuccess;
                        return
                    }
                    setStatus(mysqlStatus, json?.error ?? 'Error :(', true);
                    mysqlStatus.style.color = colorDanger;
                } else {
                    setStatus(mysqlStatus, json?.message ?? 'Failed :/', false);
                    mysqlStatus.style.color = colorDanger;
                }
            } catch (err) {
                setStatus(mysqlStatus, 'Network error', false);
                mysqlStatus.style.color = colorWarning;
            }
        });
    }

    // MongoDB
    if (mongoBtn) {
        mongoBtn.addEventListener('click', async function (e) {
            e.preventDefault();
            setStatus(mongoStatus, 'Connecting...', null);
            try {
                const res = await fetch('/api/test/mongodb', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: null,
                    credentials: 'same-origin'
                });
                const json = await res.json().catch(() => null);
                if (res.ok && json !== null) {
                    if (json.status === true) {
                        setStatus(mongoStatus, json?.message ?? 'Connected :)', true);
                        mongoStatus.style.color = colorSuccess;
                        return
                    }
                    setStatus(mongoStatus, json?.error ?? 'Error :(', true);
                    mongoStatus.style.color = colorDanger;
                } else {
                    setStatus(mongoStatus, json?.message ?? 'Failed :/', false);
                    mongoStatus.style.color = colorDanger;
                }
            } catch (err) {
                setStatus(mongoStatus, 'Network error', false);
                mongoStatus.style.color = colorWarning;
            }
        });
    }

    // Redis
    if (redisBtn) {
        redisBtn.addEventListener('click', async function (e) {
            e.preventDefault();
            setStatus(redisStatus, 'Connecting...', null);
            try {
                const res = await fetch('/api/test/redis', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: null,
                    credentials: 'same-origin'
                });
                const json = await res.json().catch(() => null);
                if (res.ok && json !== null) {
                    if (json.status === true) {
                        setStatus(redisStatus, json?.message ?? 'Connected :)', true);
                        redisStatus.style.color = colorSuccess;
                        return
                    }
                    setStatus(redisStatus, json?.error ?? 'Error :(', true);
                    redisStatus.style.color = colorDanger;
                } else {
                    setStatus(redisStatus, json?.message ?? 'Failed :/', false);
                    redisStatus.style.color = colorDanger;
                }
            } catch (err) {
                setStatus(redisStatus, 'Network error', false);
                redisStatus.style.color = colorWarning;
            }
        });
    }

    // Mailer
    if (emailBtn) {
        emailBtn.addEventListener('click', async function (e) {
            e.preventDefault();
            setStatus(emailStatus, 'Sending...', null);
            try {
                const body = {
                    subject: 'Test Mail from Home page',
                    body: 'This is a test email from the front-end',
                };
                const res = await fetch('/api/test/mail', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(body),
                    credentials: 'same-origin'
                });
                const json = await res.json().catch(() => null);
                if (res.ok && json !== null) {
                    if (json.status === true) {
                        setStatus(emailStatus, json?.message ?? 'Sent :)', true);
                        emailStatus.style.color = colorSuccess;
                        return
                    }
                    setStatus(emailStatus, json?.error ?? 'Error :(', true);
                    emailStatus.style.color = colorDanger;
                } else {
                    setStatus(emailStatus, json?.message ?? 'Failed :/', false);
                    emailStatus.style.color = colorDanger;
                }
            } catch (err) {
                setStatus(emailStatus, 'Network error', false);
                emailStatus.style.color = colorWarning;
            }
        });
    }

    // Broker
    if (queueBtn) {
        queueBtn.addEventListener('click', async function (e) {
            e.preventDefault();
            setStatus(queueStatus, 'Pushing...', null);
            try {
                const body = {
                    payload: { ts: Date.now(), note: 'from home.js' }
                };
                const res = await fetch('/api/test/queue', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(body),
                    credentials: 'same-origin'
                });
                const json = await res.json().catch(() => null);
                if (res.ok && json !== null) {
                    if (json.status === true) {
                        setStatus(queueStatus, json?.message ?? 'Queued :)', true);
                        queueStatus.style.color = colorSuccess;
                        return
                    }
                    setStatus(queueStatus, json?.error ?? 'Error :(', true);
                    queueStatus.style.color = colorDanger;
                } else {
                    setStatus(queueStatus, json?.message ?? 'Failed :/', false);
                    queueStatus.style.color = colorDanger;
                }
            } catch (err) {
                setStatus(queueStatus, 'Network error', false);
                queueStatus.style.color = colorWarning;
            }
        });
    }
});
