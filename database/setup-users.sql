    -- Used by the dbserver user to create database users and grant them the necessary privileges
    -- To limit the access to the database for security purposes
    
    CREATE USER IF NOT EXISTS 'webuser1'@'%' IDENTIFIED BY 'webuser1_pw';
        GRANT SELECT ON mydatabase.product TO 'webuser1'@'%' ;
        GRANT INSERT, UPDATE ON mydatabase.customer TO 'webuser1'@'%';

    CREATE USER IF NOT EXISTS 'webuser2'@'%' IDENTIFIED BY 'webuser2_pw';
      GRANT SELECT ON mydatabase.* TO 'webuser2'@'%';
      
     