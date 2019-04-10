<?php

class UserModel extends Model
{
    public function register()
    {
        // Sanatize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if($post['submit'])
        {
            if($post['name'] == '' || $post['email'] == '' || $post['password'] == '')
            {
                Messages::setMsg('Please fill in all fields', 'error');
                return;
            }
            // Encrypt plaintext password with md5
            $password = md5($post['password']);

            // Insert into MySQL
            $this->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
            $this->bind(':name', $post['name']);
            $this->bind(':email', $post['email']);
            $this->bind(':password', $password);
            $this->execute();
            // Verify
            if($this->lastInsertId())
            {
                header('Location: '. ROOT_URL . 'shares');
            }
        }
        return;
    }

    public function login()
    {
        // Sanatize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if($post['submit'])
        {
            // Encrypt plaintext password with md5
            $password = md5($post['password']);

            // Compare Login
            $this->query('SELECT * FROM user WHERE email = :email AND password = :password');
            $this->bind(':email', $post['email']);
            $this->bind(':password', $password);
            $this->execute();
            
            $row = $this->single();
            if($row)
            {
                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_data'] = array(
                    "id"    =>  $row['id'],
                    "name"  =>  $row['name'],
                    "email" =>  $row['email']
                );
                header('Location: '. ROOT_URL . 'shares');
            }
            else
            {
                Messages::setMsg('Incorrect Login', 'error');
            }
            
        }
        return;
    }
}

?>