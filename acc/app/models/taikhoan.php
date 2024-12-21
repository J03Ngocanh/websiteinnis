<?php
    class taikhoan{
        var $hoten;
        var $sdt;
        var $password;
        var $email;
        var $ngaysinh;
        function __construct($hoten,$sdt,$password,$email, $ngaysinh){
            $this->hoten = $hoten;
            $this->sdt=$sdt;
            $this->password=$password;
            $this->email=$email;
            $this->ngaysinh=$ngaysinh;
            
        }
        function Hoten()
        {
            return $this->hoten;
        }
        
        function Sdt()
        {
            return $this->sdt;
        }
        function Password()
        {
            return $this->password;
        }
      
        function Email()
        {
            return $this->email;
        }
        
        function Ngaysinh()
        {
            return $this->ngaysinh;
        }
    }
?>