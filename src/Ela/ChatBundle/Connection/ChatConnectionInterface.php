<?php
namespace Ela\ChatBundle\Connection;

interface ChatConnectionInterface
{
    public function getConnection();
    public function getName();
    public function setName($name);
    public function sendMsg($sender, $msg);
}
