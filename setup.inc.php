<?php
  /************************************************************/
  /* Main Vulns
  /************************************************************/
  function mainVulns($_bdd) {
    try {
      $cnx = new PDO('mysql:host='. $_bdd['server'], $_bdd['user'], $_bdd['password']);
      $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      /**********IDOR_1************/
      $idor1Queries = [
        "DROP DATABASE IF EXISTS idor1",
        "CREATE DATABASE idor1",
        "USE idor1",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'idor1-user'@'%'",
        "CREATE USER 'idor1-user'@'%' IDENTIFIED BY 'passw0rd.idor1'",
        "GRANT SELECT, INSERT ON idor1.users TO 'idor1-user'@'%';"
      ];

      foreach ($idor1Queries as $idor1Query) {
        $cnx->exec($idor1Query);
      }

      /**********IDOR_2************/
      $idor2Queries = [
        "DROP DATABASE IF EXISTS idor2",
        "CREATE DATABASE idor2",
        "USE idor2",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'idor2-user'@'%'",
        "CREATE USER 'idor2-user'@'%' IDENTIFIED BY 'passw0rd.idor2'",
        "GRANT SELECT, INSERT, UPDATE ON idor2.users TO 'idor2-user'@'%';"
      ];

      foreach ($idor2Queries as $idor2Query) {
        $cnx->exec($idor2Query);
      }

      /**********IDOR_3************/
      $idor3Queries = [
        "DROP DATABASE IF EXISTS idor3",
        "CREATE DATABASE idor3",
        "USE idor3",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, uuid TEXT, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, uuid, username, firstname, lastname, password, role) VALUES(1, '" . guidv4() . "', 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, uuid, username, firstname, lastname, password, role) VALUES(2, '" . guidv4() . "', 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, uuid, username, firstname, lastname, password, role) VALUES(3, '" . guidv4() . "', 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, uuid, username, firstname, lastname, password, role) VALUES(4, '" . guidv4() . "', 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, uuid, username, firstname, lastname, password, role) VALUES(5, '" . guidv4() . "', 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'idor3-user'@'%'",
        "CREATE USER 'idor3-user'@'%' IDENTIFIED BY 'passw0rd.idor3'",
        "GRANT SELECT, INSERT ON idor3.users TO 'idor3-user'@'%';"
      ];

      foreach ($idor3Queries as $idor3Query) {
        $cnx->exec($idor3Query);
      }

      /**********IDOR_4************/
      $idor4Queries = [
        "DROP DATABASE IF EXISTS idor4",
        "CREATE DATABASE idor4",
        "USE idor4",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, phone_number TEXT, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, phone_number, username, firstname, lastname, password, role) VALUES(1, '0612561298', 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, phone_number, username, firstname, lastname, password, role) VALUES(2, '0123457894', 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, phone_number, username, firstname, lastname, password, role) VALUES(3, '0245789865', 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, phone_number, username, firstname, lastname, password, role) VALUES(4, '0745126487', 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, phone_number, username, firstname, lastname, password, role) VALUES(5, '0199124578', 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'idor4-user'@'%'",
        "CREATE USER 'idor4-user'@'%' IDENTIFIED BY 'passw0rd.idor4'",
        "GRANT SELECT, INSERT ON idor4.users TO 'idor4-user'@'%';"
      ];

      foreach ($idor4Queries as $idor4Query) {
        $cnx->exec($idor4Query);
      }

      /**********IDOR_5************/
      $idor5Queries = [
        "DROP DATABASE IF EXISTS idor5",
        "CREATE DATABASE idor5",
        "USE idor5",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'idor5-user'@'%'",
        "CREATE USER 'idor5-user'@'%' IDENTIFIED BY 'passw0rd.idor5'",
        "GRANT SELECT, INSERT ON idor5.users TO 'idor5-user'@'%';"
      ];

      foreach ($idor5Queries as $idor5Query) {
        $cnx->exec($idor5Query);
      }

      $usersfolder = './exercices/idor/idor_5/users';
      $userfiles = glob($usersfolder . '/*');
      foreach ($userfiles as $userfile) {
        if(is_file($userfile)) {
          unlink($userfile);
        }
      }

      $userfile = './exercices/idor/idor_5/users/admin.json';
      $data = array(
        'username' => 'admin',
        'firstname' => 'John',
        'lastname' => 'Doe',
        'role' => 'administrator'
      );
      $jsonData = json_encode($data, JSON_PRETTY_PRINT);
      $file = fopen($userfile, 'w');
      fwrite($file, $jsonData);
      fclose($file);

      $userfile = './exercices/idor/idor_5/users/ameUser2001.json';
      $data = array(
        'username' => 'ameUser2001',
        'firstname' => 'Ethan',
        'lastname' => 'Smith',
        'role' => 'user'
      );
      $jsonData = json_encode($data, JSON_PRETTY_PRINT);
      $file = fopen($userfile, 'w');
      fwrite($file, $jsonData);
      fclose($file);

      $userfile = './exercices/idor/idor_5/users/techGeek.json';
      $data = array(
        'username' => 'techGeek',
        'firstname' => 'Olivia',
        'lastname' => 'Johnson',
        'role' => 'user'
      );
      $jsonData = json_encode($data, JSON_PRETTY_PRINT);
      $file = fopen($userfile, 'w');
      fwrite($file, $jsonData);
      fclose($file);

      $userfile = './exercices/idor/idor_5/users/eBrown.json';
      $data = array(
        'username' => 'eBrown',
        'firstname' => 'Emma',
        'lastname' => 'Brown',
        'role' => 'user'
      );
      $jsonData = json_encode($data, JSON_PRETTY_PRINT);
      $file = fopen($userfile, 'w');
      fwrite($file, $jsonData);
      fclose($file);

      $userfile = './exercices/idor/idor_5/users/pickles.json';
      $data = array(
        'username' => 'pickles',
        'firstname' => 'Liam',
        'lastname' => 'Miller',
        'role' => 'user'
      );
      $jsonData = json_encode($data, JSON_PRETTY_PRINT);
      $file = fopen($userfile, 'w');
      fwrite($file, $jsonData);
      fclose($file);

      /**********SQLI_1************/
      $sqli1Queries = [
        "DROP DATABASE IF EXISTS sqli1",
        "CREATE DATABASE sqli1",
        "USE sqli1",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', 'the_administrator', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', 'SecretCode!', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', 'P@ssw0rd2022', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', 'CyberSafe&23', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', 'ProtectedPwd', 'user')",
        "DROP USER IF EXISTS 'sqli1-user'@'%'",
        "CREATE USER 'sqli1-user'@'%' IDENTIFIED BY 'passw0rd.sqli1'",
        "GRANT SELECT ON sqli1.users TO 'sqli1-user'@'%';"
      ];

      foreach ($sqli1Queries as $sqli1Query) {
        $cnx->exec($sqli1Query);
      }

      /**********SQLI_2************/
      $sqli2Queries = [
        "DROP DATABASE IF EXISTS sqli2",
        "CREATE DATABASE sqli2",
        "USE sqli2",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', 'the_administrator', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', 'SecretCode!', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', 'P@ssw0rd2022', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', 'CyberSafe&23', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', 'ProtectedPwd', 'user')",
        "DROP USER IF EXISTS 'sqli2-user'@'%'",
        "CREATE USER 'sqli2-user'@'%' IDENTIFIED BY 'passw0rd.sqli2'",
        "GRANT SELECT, INSERT ON sqli2.users TO 'sqli2-user'@'%';"
      ];

      foreach ($sqli2Queries as $sqli2Query) {
        $cnx->exec($sqli2Query);
      }

      /**********SQLI_3************/
      $sqli3Queries = [
        "DROP DATABASE IF EXISTS sqli3",
        "CREATE DATABASE sqli3",
        "USE sqli3",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', 'the_administrator', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', 'SecretCode!', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', 'P@ssw0rd2022', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', 'CyberSafe&23', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', 'ProtectedPwd', 'user')",
        "DROP USER IF EXISTS 'sqli3-user'@'%'",
        "CREATE USER 'sqli3-user'@'%' IDENTIFIED BY 'passw0rd.sqli3'",
        "GRANT SELECT, INSERT ON sqli3.users TO 'sqli3-user'@'%';"
      ];

      foreach ($sqli3Queries as $sqli3Query) {
        $cnx->exec($sqli3Query);
      }

      /**********SQLI_4************/
      $sqli4Queries = [
        "DROP DATABASE IF EXISTS sqli4",
        "CREATE DATABASE sqli4",
        "USE sqli4",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', 'the_administrator', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', 'SecretCode!', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', 'P@ssw0rd2022', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', 'CyberSafe&23', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', 'ProtectedPwd', 'user')",
        "DROP USER IF EXISTS 'sqli4-user'@'%'",
        "CREATE USER 'sqli4-user'@'%' IDENTIFIED BY 'passw0rd.sqli4'",
        "GRANT SELECT, INSERT, UPDATE, DELETE ON sqli4.users TO 'sqli4-user'@'%';"
      ];

      foreach ($sqli4Queries as $sqli4Query) {
        $cnx->exec($sqli4Query);
      }

      /**********SQLI_5************/
      $sqli5Queries = [
        "DROP DATABASE IF EXISTS sqli5",
        "CREATE DATABASE sqli5",
        "USE sqli5",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', 'the_administrator', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', 'SecretCode!', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', 'P@ssw0rd2022', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', 'CyberSafe&23', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', 'ProtectedPwd', 'user')",
        "DROP USER IF EXISTS 'sqli5-user'@'%'",
        "CREATE USER 'sqli5-user'@'%' IDENTIFIED BY 'passw0rd.sqli5'",
        "GRANT SELECT, INSERT ON sqli5.users TO 'sqli5-user'@'%';"
      ];

      foreach ($sqli5Queries as $sqli5Query) {
        $cnx->exec($sqli5Query);
      }

      /**********SQLI_6************/
      $sqli6Queries = [
        "DROP DATABASE IF EXISTS sqli6",
        "CREATE DATABASE sqli6",
        "USE sqli6",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', 'the_administrator', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', 'SecretCode!', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', 'P@ssw0rd2022', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', 'CyberSafe&23', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', 'ProtectedPwd', 'user')",
        "DROP USER IF EXISTS 'sqli6-user'@'%'",
        "CREATE USER 'sqli6-user'@'%' IDENTIFIED BY 'passw0rd.sqli6'",
        "GRANT SELECT, INSERT ON sqli6.users TO 'sqli6-user'@'%';"
      ];

      foreach ($sqli6Queries as $sqli6Query) {
        $cnx->exec($sqli6Query);
      }

      /**********SQLI_7************/
      $sqli7Queries = [
        "DROP DATABASE IF EXISTS sqli7",
        "CREATE DATABASE sqli7",
        "USE sqli7",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', 'the_administrator', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', 'SecretCode!', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', 'P@ssw0rd2022', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', 'CyberSafe&23', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', 'ProtectedPwd', 'user')",
        "DROP USER IF EXISTS 'sqli7-user'@'%'",
        "CREATE USER 'sqli7-user'@'%' IDENTIFIED BY 'passw0rd.sqli7'",
        "GRANT SELECT, INSERT ON sqli7.users TO 'sqli7-user'@'%';"
      ];

      foreach ($sqli7Queries as $sqli7Query) {
        $cnx->exec($sqli7Query);
      }

      /**********SQLI_8************/
      $sqli8Queries = [
        "DROP DATABASE IF EXISTS sqli8",
        "CREATE DATABASE sqli8",
        "USE sqli8",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', 'the_administrator', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', 'SecretCode!', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', 'P@ssw0rd2022', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', 'CyberSafe&23', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', 'ProtectedPwd', 'user')",
        "DROP USER IF EXISTS 'sqli8-user'@'%'",
        "CREATE USER 'sqli8-user'@'%' IDENTIFIED BY 'passw0rd.sqli8'",
        "GRANT SELECT, INSERT ON sqli8.users TO 'sqli8-user'@'%';",
        "GRANT FILE ON *.* TO 'sqli8-user'@'%';"
      ];

      foreach ($sqli8Queries as $sqli8Query) {
        $cnx->exec($sqli8Query);
      }

      /**********SQLI_9************/
      $sqli9Queries = [
        "DROP DATABASE IF EXISTS sqli9",
        "CREATE DATABASE sqli9",
        "USE sqli9",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', 'the_administrator', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', 'SecretCode!', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', 'P@ssw0rd2022', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', 'CyberSafe&23', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', 'ProtectedPwd', 'user')",
        "DROP USER IF EXISTS 'sqli9-user'@'%'",
        "CREATE USER 'sqli9-user'@'%' IDENTIFIED BY 'passw0rd.sqli9'",
        "GRANT SELECT, INSERT ON sqli9.users TO 'sqli9-user'@'%';",
        "GRANT FILE ON *.* TO 'sqli9-user'@'%';"
      ];

      foreach ($sqli9Queries as $sqli9Query) {
        $cnx->exec($sqli9Query);
      }

      $usersfolder = './exercices/sqli/sqli_9/public';
      $userfiles = glob($usersfolder . '/*');
      foreach ($userfiles as $userfile) {
        if(is_file($userfile)) {
          unlink($userfile);
        }
      }

      $sourceFilePath = './exercices/sqli/sqli_9/backup/OWASP_Top_10-2017.pdf';
      $destinationFilePath = './exercices/sqli/sqli_9/public/OWASP_Top_10-2017.pdf';
      copy($sourceFilePath, $destinationFilePath);

      /**********OS_INJECTION_1************/
      $osinjection1Queries = [
        "DROP DATABASE IF EXISTS osinjection1",
        "CREATE DATABASE osinjection1",
        "USE osinjection1",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'osinjection1-user'@'%'",
        "CREATE USER 'osinjection1-user'@'%' IDENTIFIED BY 'passw0rd.osinjection1'",
        "GRANT SELECT ON osinjection1.users TO 'osinjection1-user'@'%';"
      ];

      foreach ($osinjection1Queries as $osinjection1Query) {
        $cnx->exec($osinjection1Query);    
      }

      /**********OS_INJECTION_2************/
      $osinjection2Queries = [
        "DROP DATABASE IF EXISTS osinjection2",
        "CREATE DATABASE osinjection2",
        "USE osinjection2",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'osinjection2-user'@'%'",
        "CREATE USER 'osinjection2-user'@'%' IDENTIFIED BY 'passw0rd.osinjection2'",
        "GRANT SELECT, INSERT, DELETE ON osinjection2.users TO 'osinjection2-user'@'%';"
      ];

      foreach ($osinjection2Queries as $osinjection2Query) {
        $cnx->exec($osinjection2Query);
      }

      $usersfolder = './exercices/osinjection/osinjection_2/users';
      $userfiles = glob($usersfolder . '/*');
      foreach ($userfiles as $userfile) {
        if(is_file($userfile)) {
          unlink($userfile);
        }
      }

      $userfile = './exercices/osinjection/osinjection_2/users/admin.json';
      $data = array(
        'username' => 'admin',
        'firstname' => 'John',
        'lastname' => 'Doe',
        'role' => 'administrator'
      );
      $jsonData = json_encode($data, JSON_PRETTY_PRINT);
      $file = fopen($userfile, 'w');
      fwrite($file, $jsonData);
      fclose($file);

      $userfile = './exercices/osinjection/osinjection_2/users/ameUser2001.json';
      $data = array(
        'username' => 'ameUser2001',
        'firstname' => 'Ethan',
        'lastname' => 'Smith',
        'role' => 'user'
      );
      $jsonData = json_encode($data, JSON_PRETTY_PRINT);
      $file = fopen($userfile, 'w');
      fwrite($file, $jsonData);
      fclose($file);

      $userfile = './exercices/osinjection/osinjection_2/users/techGeek.json';
      $data = array(
        'username' => 'techGeek',
        'firstname' => 'Olivia',
        'lastname' => 'Johnson',
        'role' => 'user'
      );
      $jsonData = json_encode($data, JSON_PRETTY_PRINT);
      $file = fopen($userfile, 'w');
      fwrite($file, $jsonData);
      fclose($file);

      $userfile = './exercices/osinjection/osinjection_2/users/eBrown.json';
      $data = array(
        'username' => 'eBrown',
        'firstname' => 'Emma',
        'lastname' => 'Brown',
        'role' => 'user'
      );
      $jsonData = json_encode($data, JSON_PRETTY_PRINT);
      $file = fopen($userfile, 'w');
      fwrite($file, $jsonData);
      fclose($file);

      $userfile = './exercices/osinjection/osinjection_2/users/pickles.json';
      $data = array(
        'username' => 'pickles',
        'firstname' => 'Liam',
        'lastname' => 'Miller',
        'role' => 'user'
      );
      $jsonData = json_encode($data, JSON_PRETTY_PRINT);
      $file = fopen($userfile, 'w');
      fwrite($file, $jsonData);
      fclose($file);

      /**********CODE_INJECTION_1************/
      $codeinjection1Queries = [
        "DROP DATABASE IF EXISTS codeinjection1",
        "CREATE DATABASE codeinjection1",
        "USE codeinjection1",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'codeinjection1-user'@'%'",
        "CREATE USER 'codeinjection1-user'@'%' IDENTIFIED BY 'passw0rd.codeinjection1'",
        "GRANT SELECT, INSERT ON codeinjection1.users TO 'codeinjection1-user'@'%';"
      ];

      foreach ($codeinjection1Queries as $codeinjection1Query) {
        $cnx->exec($codeinjection1Query);    
      }

      /**********CODE_INJECTION_2************/
      $codeinjection2Queries = [
        "DROP DATABASE IF EXISTS codeinjection2",
        "CREATE DATABASE codeinjection2",
        "USE codeinjection2",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'codeinjection2-user'@'%'",
        "CREATE USER 'codeinjection2-user'@'%' IDENTIFIED BY 'passw0rd.codeinjection2'",
        "GRANT SELECT, INSERT ON codeinjection2.users TO 'codeinjection2-user'@'%';"
      ];

      foreach ($codeinjection2Queries as $codeinjection2Query) {
        $cnx->exec($codeinjection2Query);    
      }

      $usersfolder = './exercices/codeinjection/codeinjection_2/uploads';
      $userfiles = glob($usersfolder . '/*');
      foreach ($userfiles as $userfile) {
        if(is_file($userfile)) {
          unlink($userfile);
        }
      }

      $sourceFilePath = './exercices/codeinjection/codeinjection_2/backup/readme.txt';
      $destinationFilePath = './exercices/codeinjection/codeinjection_2/uploads/readme.txt';
      copy($sourceFilePath, $destinationFilePath);

      /**********XSS_INJECTION_1************/
      $xssinjection1Queries = [
        "DROP DATABASE IF EXISTS xssinjection1",
        "CREATE DATABASE xssinjection1",
        "USE xssinjection1",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'xssinjection1-user'@'%'",
        "CREATE USER 'xssinjection1-user'@'%' IDENTIFIED BY 'passw0rd.xssinjection1'",
        "GRANT SELECT, INSERT ON xssinjection1.users TO 'xssinjection1-user'@'%';"
      ];

      foreach ($xssinjection1Queries as $xssinjection1Query) {
        $cnx->exec($xssinjection1Query);    
      }

      /**********XSS_INJECTION_2************/
      $xssinjection2Queries = [
        "DROP DATABASE IF EXISTS xssinjection2",
        "CREATE DATABASE xssinjection2",
        "USE xssinjection2",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "CREATE TABLE messages (id INT AUTO_INCREMENT PRIMARY KEY, user_id INT, message TEXT)",
        "INSERT INTO messages(id, user_id, message) VALUES(1, 1, 'La messagerie est enfin opérationnelle !')",
        "DROP USER IF EXISTS 'xssinjection2-user'@'%'",
        "CREATE USER 'xssinjection2-user'@'%' IDENTIFIED BY 'passw0rd.xssinjection2'",
        "GRANT SELECT, INSERT ON xssinjection2.users TO 'xssinjection2-user'@'%';",
        "GRANT SELECT, INSERT ON xssinjection2.messages TO 'xssinjection2-user'@'%';",
      ];

      foreach ($xssinjection2Queries as $xssinjection2Query) {
        $cnx->exec($xssinjection2Query);    
      }

      /**********XSS_INJECTION_3************/
      $xssinjection3Queries = [
        "DROP DATABASE IF EXISTS xssinjection3",
        "CREATE DATABASE xssinjection3",
        "USE xssinjection3",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'xssinjection3-user'@'%'",
        "CREATE USER 'xssinjection3-user'@'%' IDENTIFIED BY 'passw0rd.xssinjection3'",
        "GRANT SELECT, INSERT ON xssinjection3.users TO 'xssinjection3-user'@'%';"
      ];

      foreach ($xssinjection3Queries as $xssinjection3Query) {
        $cnx->exec($xssinjection3Query);    
      }

      /**********BROKEN_AUTHENTICATION_1************/
      $broken_authentication1Queries = [
        "DROP DATABASE IF EXISTS broken_authentication1",
        "CREATE DATABASE broken_authentication1",
        "USE broken_authentication1",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'broken_authentication1-user'@'%'",
        "CREATE USER 'broken_authentication1-user'@'%' IDENTIFIED BY 'passw0rd.broken_authentication1'",
        "GRANT SELECT, INSERT ON broken_authentication1.users TO 'broken_authentication1-user'@'%';"
      ];

      foreach ($broken_authentication1Queries as $broken_authentication1Query) {
        $cnx->exec($broken_authentication1Query);
      }

      /**********BROKEN_AUTHENTICATION_2************/
      $broken_authentication2Queries = [
        "DROP DATABASE IF EXISTS broken_authentication2",
        "CREATE DATABASE broken_authentication2",
        "USE broken_authentication2",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'broken_authentication2-user'@'%'",
        "CREATE USER 'broken_authentication2-user'@'%' IDENTIFIED BY 'passw0rd.broken_authentication2'",
        "GRANT SELECT, INSERT ON broken_authentication2.users TO 'broken_authentication2-user'@'%';"
      ];

      foreach ($broken_authentication2Queries as $broken_authentication2Query) {
        $cnx->exec($broken_authentication2Query);
      }

      /**********BROKEN_AUTHENTICATION_3************/
      $broken_authentication3Queries = [
        "DROP DATABASE IF EXISTS broken_authentication3",
        "CREATE DATABASE broken_authentication3",
        "USE broken_authentication3",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'broken_authentication3-user'@'%'",
        "CREATE USER 'broken_authentication3-user'@'%' IDENTIFIED BY 'passw0rd.broken_authentication3'",
        "GRANT SELECT, INSERT ON broken_authentication3.users TO 'broken_authentication3-user'@'%';"
      ];

      foreach ($broken_authentication3Queries as $broken_authentication3Query) {
        $cnx->exec($broken_authentication3Query);
      }

      /**********BROKEN_ACCESS_CONTROL_1************/
      $broken_access_control1Queries = [
        "DROP DATABASE IF EXISTS broken_access_control1",
        "CREATE DATABASE broken_access_control1",
        "USE broken_access_control1",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'jule12', 'John', 'Doe', '" . password_hash('jule12', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'broken_access_control1-user'@'%'",
        "CREATE USER 'broken_access_control1-user'@'%' IDENTIFIED BY 'passw0rd.broken_access_control1'",
        "GRANT SELECT, INSERT, UPDATE ON broken_access_control1.users TO 'broken_access_control1-user'@'%';"
      ];

      foreach ($broken_access_control1Queries as $broken_access_control1Query) {
        $cnx->exec($broken_access_control1Query);
      }

      /**********BROKEN_ACCESS_CONTROL_2************/
      $broken_access_control2Queries = [
        "DROP DATABASE IF EXISTS broken_access_control2",
        "CREATE DATABASE broken_access_control2",
        "USE broken_access_control2",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'broken_access_control2-user'@'%'",
        "CREATE USER 'broken_access_control2-user'@'%' IDENTIFIED BY 'passw0rd.broken_access_control2'",
        "GRANT SELECT, INSERT, UPDATE ON broken_access_control2.users TO 'broken_access_control2-user'@'%';"
      ];

      foreach ($broken_access_control2Queries as $broken_access_control2Query) {
        $cnx->exec($broken_access_control2Query);
      }

      /**********OPEN_REDIRECT_1************/
      $open_redirect1Queries = [
        "DROP DATABASE IF EXISTS open_redirect1",
        "CREATE DATABASE open_redirect1",
        "USE open_redirect1",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'open_redirect1-user'@'%'",
        "CREATE USER 'open_redirect1-user'@'%' IDENTIFIED BY 'passw0rd.open_redirect1'",
        "GRANT SELECT, INSERT ON open_redirect1.users TO 'open_redirect1-user'@'%';"
      ];

      foreach ($open_redirect1Queries as $open_redirect1Query) {
        $cnx->exec($open_redirect1Query);
      }

      /**********CROSS_SITE_REQUEST_FORGERY_1************/
      $cross_site_request_forgery1Queries = [
        "DROP DATABASE IF EXISTS cross_site_request_forgery1",
        "CREATE DATABASE cross_site_request_forgery1",
        "USE cross_site_request_forgery1",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'cross_site_request_forgery1-user'@'%'",
        "CREATE USER 'cross_site_request_forgery1-user'@'%' IDENTIFIED BY 'passw0rd.cross_site_request_forgery1'",
        "GRANT SELECT, INSERT, UPDATE ON cross_site_request_forgery1.users TO 'cross_site_request_forgery1-user'@'%';"
      ];

      foreach ($cross_site_request_forgery1Queries as $cross_site_request_forgery1Query) {
        $cnx->exec($cross_site_request_forgery1Query);
      }

      /**********CROSS_SITE_REQUEST_FORGERY_2************/
      $cross_site_request_forgery2Queries = [
        "DROP DATABASE IF EXISTS cross_site_request_forgery2",
        "CREATE DATABASE cross_site_request_forgery2",
        "USE cross_site_request_forgery2",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'cross_site_request_forgery2-user'@'%'",
        "CREATE USER 'cross_site_request_forgery2-user'@'%' IDENTIFIED BY 'passw0rd.cross_site_request_forgery2'",
        "GRANT SELECT, INSERT, UPDATE ON cross_site_request_forgery2.users TO 'cross_site_request_forgery2-user'@'%';"
      ];

      foreach ($cross_site_request_forgery2Queries as $cross_site_request_forgery2Query) {
        $cnx->exec($cross_site_request_forgery2Query);
      }

      header("Location: setup.php?message=" . urlencode("Base de données créée ou réinitialisée avec succès. Déconnectez-vous des sessions de vos utilisateurs précédemment créés."), true, 302);
    }
    catch(Exception $e) {
      header("Location: setup.php?error=" . urlencode(($e->getMessage())), true, 302);
      exit();
    }
  }

  /************************************************************/
  /* Other Vulns
  /************************************************************/
  function otherVulns($_bdd) {
    try {
      $cnx = new PDO('mysql:host='. $_bdd['server'], $_bdd['user'], $_bdd['password']);
      $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      /**********BUSINESS_LOGIC_VULNERABILITY_1************/
      $business_logic_vulnerability1Queries = [
        "DROP DATABASE IF EXISTS business_logic_vulnerability1",
        "CREATE DATABASE business_logic_vulnerability1",
        "USE business_logic_vulnerability1",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT, rating INTEGER)",
        "INSERT INTO users(id, username, firstname, lastname, password, role, rating) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator', 5)",
        "INSERT INTO users(id, username, firstname, lastname, password, role, rating) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user', 3)",
        "INSERT INTO users(id, username, firstname, lastname, password, role, rating) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user', 3)",
        "INSERT INTO users(id, username, firstname, lastname, password, role, rating) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user', 5)",
        "INSERT INTO users(id, username, firstname, lastname, password, role, rating) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user', 4)",
        "INSERT INTO users(id, username, firstname, lastname, password, role, rating) VALUES(6, 'martin', 'Stephen', 'Julia', '" . password_hash('breed', PASSWORD_DEFAULT) . "', 'user', 4)",
        "INSERT INTO users(id, username, firstname, lastname, password, role, rating) VALUES(7, 'love', 'Simon', 'Berry', '" . password_hash('appear', PASSWORD_DEFAULT) . "', 'user', 4)",
        "INSERT INTO users(id, username, firstname, lastname, password, role, rating) VALUES(8, 'highnoon', 'Ryanne', 'Harper', '" . password_hash('poison', PASSWORD_DEFAULT) . "', 'user', 4)",
        "INSERT INTO users(id, username, firstname, lastname, password, role, rating) VALUES(9, 'hydra', 'Nick', 'Philip', '" . password_hash('revolution', PASSWORD_DEFAULT) . "', 'user', 4)",
        "INSERT INTO users(id, username, firstname, lastname, password, role, rating) VALUES(10, 'eggs', 'Danita', 'Grant', '" . password_hash('rain', PASSWORD_DEFAULT) . "', 'user', 4)",
        "INSERT INTO users(id, username, firstname, lastname, password, role, rating) VALUES(11, 'thejoker', 'Jaimi', 'Burns', '" . password_hash('fresh', PASSWORD_DEFAULT) . "', 'user', 4)",
        "INSERT INTO users(id, username, firstname, lastname, password, role, rating) VALUES(12, 'funnycat', 'Nikol', 'Shaw', '" . password_hash('commission', PASSWORD_DEFAULT) . "', 'user', 4)",
        "INSERT INTO users(id, username, firstname, lastname, password, role, rating) VALUES(13, 'lovepets', 'Angela', 'Green', '" . password_hash('cancel', PASSWORD_DEFAULT) . "', 'user', 4)",
        "INSERT INTO users(id, username, firstname, lastname, password, role, rating) VALUES(14, 'eatandburn', 'Daniela', 'Chavez', '" . password_hash('empirical', PASSWORD_DEFAULT) . "', 'user', 4)",
        "INSERT INTO users(id, username, firstname, lastname, password, role, rating) VALUES(15, 'pray001', 'Dericka', 'Nikolia', '" . password_hash('conservation', PASSWORD_DEFAULT) . "', 'user', 4)",
        "DROP USER IF EXISTS 'business_logic_vulnerability1-user'@'%'",
        "CREATE USER 'business_logic_vulnerability1-user'@'%' IDENTIFIED BY 'passw0rd.business_logic_vulnerability1'",
        "GRANT SELECT, INSERT, UPDATE ON business_logic_vulnerability1.users TO 'business_logic_vulnerability1-user'@'%';"
      ];

      foreach ($business_logic_vulnerability1Queries as $business_logic_vulnerability1Query) {
        $cnx->exec($business_logic_vulnerability1Query);
      }

      /**********BUSINESS_LOGIC_VULNERABILITY_2************/
      $business_logic_vulnerability2Queries = [
        "DROP DATABASE IF EXISTS business_logic_vulnerability2",
        "CREATE DATABASE business_logic_vulnerability2",
        "USE business_logic_vulnerability2",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'business_logic_vulnerability2-user'@'%'",
        "CREATE USER 'business_logic_vulnerability2-user'@'%' IDENTIFIED BY 'passw0rd.business_logic_vulnerability2'",
        "GRANT SELECT, INSERT, UPDATE ON business_logic_vulnerability2.users TO 'business_logic_vulnerability2-user'@'%';"
      ];

      foreach ($business_logic_vulnerability2Queries as $business_logic_vulnerability2Query) {
        $cnx->exec($business_logic_vulnerability2Query);
      }

      /**********INSECURE_DESERIALIZATION_1************/
      $insecure_deserialization1Queries = [
        "DROP DATABASE IF EXISTS insecure_deserialization1",
        "CREATE DATABASE insecure_deserialization1",
        "USE insecure_deserialization1",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'insecure_deserialization1-user'@'%'",
        "CREATE USER 'insecure_deserialization1-user'@'%' IDENTIFIED BY 'passw0rd.insecure_deserialization1'",
        "GRANT SELECT, INSERT ON insecure_deserialization1.users TO 'insecure_deserialization1-user'@'%';"
      ];

      foreach ($insecure_deserialization1Queries as $insecure_deserialization1Query) {
        $cnx->exec($insecure_deserialization1Query);
      }

      /**********INSECURE_DESERIALIZATION_2************/
      $insecure_deserialization2Queries = [
        "DROP DATABASE IF EXISTS insecure_deserialization2",
        "CREATE DATABASE insecure_deserialization2",
        "USE insecure_deserialization2",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'insecure_deserialization2-user'@'%'",
        "CREATE USER 'insecure_deserialization2-user'@'%' IDENTIFIED BY 'passw0rd.insecure_deserialization2'",
        "GRANT SELECT, INSERT ON insecure_deserialization2.users TO 'insecure_deserialization2-user'@'%';"
      ];

      foreach ($insecure_deserialization2Queries as $insecure_deserialization2Query) {
        $cnx->exec($insecure_deserialization2Query);
      }

      /**********REGULAR_EXPRESSION_DENIAL_OF_SERVICE_1************/
      $regular_expression_denial_of_service1Queries = [
        "DROP DATABASE IF EXISTS regular_expression_denial_of_service1",
        "CREATE DATABASE regular_expression_denial_of_service1",
        "USE regular_expression_denial_of_service1",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "CREATE TABLE messages (id INT AUTO_INCREMENT PRIMARY KEY, user_id INT, message TEXT)",
        "INSERT INTO messages(id, user_id, message) VALUES(1, 1, 'La messagerie est enfin opérationnelle !')",
        "DROP USER IF EXISTS 'regular_expression_denial_of_service1-user'@'%'",
        "CREATE USER 'regular_expression_denial_of_service1-user'@'%' IDENTIFIED BY 'passw0rd.regular_expression_denial_of_service1'",
        "GRANT SELECT, INSERT ON regular_expression_denial_of_service1.users TO 'regular_expression_denial_of_service1-user'@'%';",
        "GRANT SELECT, INSERT ON regular_expression_denial_of_service1.messages TO 'regular_expression_denial_of_service1-user'@'%';",
      ];

      foreach ($regular_expression_denial_of_service1Queries as $regular_expression_denial_of_service1Query) {
        $cnx->exec($regular_expression_denial_of_service1Query);    
      }

       /**********SSRF_1************/
       $ssrf1Queries = [
        "DROP DATABASE IF EXISTS ssrf1",
        "CREATE DATABASE ssrf1",
        "USE ssrf1",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT, avatar TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role, avatar) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator', 'https://avataaars.io/?avatarStyle=Circle&topType=LongHairCurvy&accessoriesType=Prescription01&hairColor=Black&facialHairType=BeardMajestic&facialHairColor=BrownDark&clotheType=Hoodie&clotheColor=Gray01&eyeType=Happy&eyebrowType=FlatNatural&mouthType=Grimace&skinColor=Brown')",
        "INSERT INTO users(id, username, firstname, lastname, password, role, avatar) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user', 'https://avataaars.io/?avatarStyle=Circle&topType=ShortHairDreads01&accessoriesType=Blank&hairColor=PastelPink&facialHairType=Blank&facialHairColor=BlondeGolden&clotheType=GraphicShirt&clotheColor=Blue03&graphicType=Skull&eyeType=Happy&eyebrowType=RaisedExcitedNatural&mouthType=Eating&skinColor=DarkBrown')",
        "INSERT INTO users(id, username, firstname, lastname, password, role, avatar) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user', 'https://avataaars.io/?avatarStyle=Circle&topType=LongHairStraight&accessoriesType=Blank&hairColor=BrownDark&facialHairType=Blank&clotheType=BlazerShirt&eyeType=Default&eyebrowType=Default&mouthType=Default&skinColor=Light')",
        "INSERT INTO users(id, username, firstname, lastname, password, role, avatar) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user', 'https://avataaars.io/?avatarStyle=Circle&topType=LongHairNotTooLong&accessoriesType=Kurt&hairColor=Red&facialHairType=Blank&facialHairColor=Red&clotheType=CollarSweater&clotheColor=PastelGreen&eyeType=Cry&eyebrowType=DefaultNatural&mouthType=ScreamOpen&skinColor=Light')",
        "INSERT INTO users(id, username, firstname, lastname, password, role, avatar) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user', 'https://avataaars.io/?avatarStyle=Circle&topType=WinterHat1&accessoriesType=Kurt&hatColor=Red&hairColor=SilverGray&facialHairType=MoustacheFancy&facialHairColor=Platinum&clotheType=ShirtVNeck&clotheColor=Red&graphicType=Diamond&eyeType=EyeRoll&eyebrowType=AngryNatural&mouthType=Serious&skinColor=Tanned')",
        "DROP USER IF EXISTS 'ssrf1-user'@'%'",
        "CREATE USER 'ssrf1-user'@'%' IDENTIFIED BY 'passw0rd.ssrf1'",
        "GRANT SELECT, INSERT ON ssrf1.users TO 'ssrf1-user'@'%';"
      ];

      foreach ($ssrf1Queries as $ssrf1Query) {
        $cnx->exec($ssrf1Query);
      }

      /**********XXE_1************/
      $xxe1Queries = [
        "DROP DATABASE IF EXISTS xxe1",
        "CREATE DATABASE xxe1",
        "USE xxe1",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'xxe1-user'@'%'",
        "CREATE USER 'xxe1-user'@'%' IDENTIFIED BY 'passw0rd.xxe1'",
        "GRANT SELECT, INSERT ON xxe1.users TO 'xxe1-user'@'%';"
      ];

      foreach ($xxe1Queries as $xxe1Query) {
        $cnx->exec($xxe1Query);
      }

      /**********XXE_2************/
      $xxe2Queries = [
        "DROP DATABASE IF EXISTS xxe2",
        "CREATE DATABASE xxe2",
        "USE xxe2",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'xxe2-user'@'%'",
        "CREATE USER 'xxe2-user'@'%' IDENTIFIED BY 'passw0rd.xxe2'",
        "GRANT SELECT, INSERT ON xxe2.users TO 'xxe2-user'@'%';"
      ];

      foreach ($xxe2Queries as $xxe2Query) {
        $cnx->exec($xxe2Query);
      }

      /**********SSTI_1************/
      $ssti1Queries = [
        "DROP DATABASE IF EXISTS ssti1",
        "CREATE DATABASE ssti1",
        "USE ssti1",
        "CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY, username TEXT, firstname TEXT, lastname TEXT, password TEXT, role TEXT)",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(1, 'admin', 'John', 'Doe', '" . password_hash('the_administrator', PASSWORD_DEFAULT) . "', 'administrator')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(2, 'ameUser2001', 'Ethan', 'Smith', '" . password_hash('SecretCode!', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(3, 'techGeek', 'Olivia', 'Johnson', '" . password_hash('P@ssw0rd2022', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(4, 'eBrown', 'Emma', 'Brown', '" . password_hash('CyberSafe&23', PASSWORD_DEFAULT) . "', 'user')",
        "INSERT INTO users(id, username, firstname, lastname, password, role) VALUES(5, 'pickles', 'Liam', 'Miller', '" . password_hash('ProtectedPwd', PASSWORD_DEFAULT) . "', 'user')",
        "DROP USER IF EXISTS 'ssti1-user'@'%'",
        "CREATE USER 'ssti1-user'@'%' IDENTIFIED BY 'passw0rd.ssti1'",
        "GRANT SELECT, INSERT, UPDATE ON ssti1.users TO 'ssti1-user'@'%';"
      ];

      foreach ($ssti1Queries as $ssti1Query) {
        $cnx->exec($ssti1Query);
      }     

      header("Location: setup.php?message=" . urlencode("Base de données créée ou réinitialisée avec succès. Déconnectez-vous des sessions de vos utilisateurs précédemment créés."), true, 302);
    }
    catch(Exception $e) {
      header("Location: setup.php?error=" . urlencode(($e->getMessage())), true, 302);
      exit();
    }
  }
?>