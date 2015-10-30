<?php

/*
 * @author         N3X
 * @copyright      Copyright (c) 2015, Ilya Beliaev
 * @since          Version 1.0
 * 
 * $Id$
 * $Date$
 */

namespace TSCore\Adapter;

use TeamSpeak3\TeamSpeak3;
use Zend\Stdlib\Exception\InvalidArgumentException;
use TeamSpeak3\Node\Host;

class Teamspeak3Adapter implements Teamspeak3AdapterInterface{

    protected $ts;
    protected $config;
    
    public function connect() {
        $config = $this->getConfig();
        $username = $config["username"];
        $password = $config["password"];
        $server = $config["server"];
        $port = $config["port"];
        $ts = TeamSpeak3::factory("serverquery://$username:$password@$server:$port/");
        $this->setTeamspeak($ts);
        return $this;
    }

    /**
     * Get Teamspeak
     * @return Host
     */
    public function getTeamspeak() {
        return $this->ts;
    }

    /**
     * Set Teamspeak
     * @param Host $teamspeak
     */
    public function setTeamspeak(Host $teamspeak) {
        $this->ts = $teamspeak;
    }

    public function getConfig() {
        return $this->config;
    }

    public function setConfig(array $config) {
        if(!array_key_exists("username", $config)){
            $config["username"] = "Admin";
        }
        
        if(!array_key_exists("password", $config)){
            $config["password"] = "Admin";
        }
        
        if(!array_key_exists("server", $config)){
            throw new InvalidArgumentException("Servername for Teamspeak-Server not set");
        }
        
        if(!array_key_exists("port", $config)){
            throw new InvalidArgumentException("Port for Teamspeak-Server not set");
        }
        
        $this->config = $config;
        return $this;
    }

}
