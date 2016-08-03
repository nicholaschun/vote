<?php

/* Created by Mamiya Nicholas
website: http://www.cripxsolutions.com
email:cripx@cripxsoutions.com
date:1st August 2014
*/


//Define configrations

define ('DB_SERVER','localhost');
define ('DB_NAME','ivote');
define ('DB_USER','root');
define ('DB_PASS','');

class Database
{
    private $host = DB_SERVER;
    private $db_name = DB_NAME;
    private $db_pass = DB_PASS;
    private $db_user = DB_USER;
    private $dbh;
    private $error;
    private $stmt;
    private $admin_home = "../admin/home.php";
    private $login_page = "../admin/login.php";
    private $false_login = "falselogin.php";
    private $student_home = "../public/prez.php";
    private $student = "../public/login.php";
    private $voted = "../public/voted.php";
    private $f_student = "../public/falselogin.php";


    public function __construct()
    {
        //set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

        //set options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION

        );

        try {
            $this->dbh = new PDO($dsn, $this->db_user, $this->db_pass, $options);
        } //catch errors
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                default:
                    $type = PDO::PARAM_STR;

            }
        }

        $this->stmt->bindValue($param, $value, $type);

    }

    public function  execute()
    {
        return $this->stmt->execute();
    }


    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function rowCount($query)
    {
        return $this->stmt->rowCount($query);
    }


    public function lastInsertedId()
    {
        return $this->dbh->lastInsertId();
    }

    public function beginTransaction()
    {
        return $this->dbh->beginTransaction();
    }

    public function endTransaction()
    {
        return $this->dbh->commit();
    }

    public function cancelTransaction()
    {
        return $this->dbh->rollBack();
    }

// for administrator
    public function admin_login($username, $password)
    {
        $this->query("SELECT password,password_salt,username FROM admin WHERE username = :username LIMIT 1");
        $this->bind(':username', $username);
        if ($this->execute()) {
            $check = $this->single();
            $hash = hash('sha256', $check['password_salt'] . hash('sha256', $password));
            if ($hash != $check['password']) {
                header("location:" . $this->false_login);
            } elseif ($this->rowCount($check) == 1) {
                $_SESSION['admin'] = true;
                $_SESSION['id'] = $check['username'];
                return true;

            } else {
                header("location:" . $this->login_page);
            }
        }

    }


    public function admin()
    {
        return $_SESSION['id'];
    }

    public function get_admin_session()
    {
        return $_SESSION['admin'];
    }

    public function return_search()
    {
        return $this->stmt->fetchAll();
    }

    public function count_id(){
        $this->query("SELECT COUNT(*) FROM disk");
        $fat = $this->execute();
        $row = $this->rowCount($fat);
        return $row;
    }

    public function count_student(){
        $this->query("SELECT COUNT(*) FROM students_info");
        $this->execute();
        $row = $this->return_search();
        return array_shift($row);
    }





// for students
    public function student($username, $password)
    {
        $this->query("SELECT * FROM vregister WHERE username = :username LIMIT 1 ");
        $this->bind(':username', $username);
        $this->execute();
        $student = $this->single();

        if ($username !== $student['username'] || $password !== $student['password']) {
            header("Location:" . $this->f_student);

        }
        elseif($student['session'] == 'set' || $student['status'] == 'voted'){
            header("location:" . $this->voted);
            return false;

        }elseif ($this->rowCount($student) == 1) {
            $_SESSION['student'] = true;
            $_SESSION['stud'] = $student['username'];

            $this->query("UPDATE vregister SET session = 'set' WHERE username = :username");
            $this->bind(':username',$username);
            $this->execute();
            return true;
        }
        else {
            header("location:" . $this->student);
        }
    }

    public function stud()
    {
        return $_SESSION['stud'];
    }

    public function get_student()
    {
        return $_SESSION['student'];
    }

    public function student_home()
    {
        return $this->student_home;
    }

    public function user()
    {
        return $_SESSION['id'];
    }

    //return staff home page
    public function s_home_page()
    {
        return $this->staff_home;
    }

    public function admin_home()
    {
        return $this->admin_home;
    }


    //getting the session
    public function get_session()
    {
        return $_SESSION['login'];
    }

    public function user_logout()
    {
        $_SESSION['login'] = false;
        session_destroy();
        header("Location" . $this->s_login_page);
    }

    public function admin_logout()
    {
        $_SESSION['admin'] = false;
        session_destroy();
        header("Location" . $this->admin_home);
    }


    public function mysql_prep($value)
    {

        $magic_quotes_active = get_magic_quotes_gpc();
        $new_enough_php = function_exists("mysql_real_escape_string"); // i.e. PHP >= v4.3.0
        if ($new_enough_php) { // PHP v4.3.0 or higher
            // undo any magic quote effects so mysql_real_escape_string can do the work
            if ($magic_quotes_active) {
                $value = stripslashes($value);
            }
            $value = mysql_real_escape_string($value);
        } else { // before PHP v4.3.0
            // if magic quotes aren't already on then add slashes manually
            if (!$magic_quotes_active) {
                $value = addslashes($value);
            }
            // if magic quotes are active, then the slashes already exist
        }
        return $value;
    }

    public function createSalt()
    {
        $string = md5(uniqid(rand(), true));
        return substr($string, 0, 5);
    }

    public function hash_pass($pass, $salt)
    {
        $hash = hash('sha256', $pass);
        $hash = hash('sha256', $salt . $hash);
        return $hash;
    }


    public function generate_password()
{
    $length = 4;
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = substr(str_shuffle($chars), 0, $length);
    return $password;

}

}




?>