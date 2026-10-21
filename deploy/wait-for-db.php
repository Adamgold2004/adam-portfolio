<?php
// Wait for the private MySQL service without printing connection credentials.
mysqli_report(MYSQLI_REPORT_OFF);
for ($attempt = 0; $attempt < 60; $attempt++) {
    $connection = @mysqli_connect(
        getenv('WORDPRESS_DB_HOST'),
        getenv('WORDPRESS_DB_USER'),
        getenv('WORDPRESS_DB_PASSWORD'),
        getenv('WORDPRESS_DB_NAME')
    );
    if ($connection) {
        mysqli_close($connection);
        exit(0);
    }
    sleep(2);
}
fwrite(STDERR, "Database was not ready after 120 seconds. Check the private service and environment variables.\n");
exit(1);
