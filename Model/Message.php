<?php

namespace TDM\SwiftMailerEventBundle\Model;

use \Swift_Message;
use TDM\SwiftMailerEventBundle\Model\MessageMetadataInterface;

/**
 * Description of Message
 *
 * @author wpigott
 */
class Message extends Swift_Message implements MessageMetadataInterface {

    private $metadata = array();

    public function addMetadata($email, array $metadata) {
        $this->metadata[$email] = $metadata;
    }

    public function setMetadata($email, $key, $value) {
        $this->metadata[$email][$key] = $value;
    }

    public function hasMetadata($email, $key = null) {
        return (
            !empty($this->metadata[$email])
            &&
            is_array($this->metadata[$email])
            &&
            (is_null($key) || isset($this->metadata[$email][$key]))
        );
    }

    public function getMetadata($email = null, $key = null) {
        if (is_null($email)) {
            return $this->metadata;
        }
        elseif (is_null($key)) {
            return $this->metadata[$email];
        }
        else {
            return $this->metadata[$email][$key];
        }
    }

    public function clearMetadata($email = null) {
        if (!is_null($email)) {
            unset($this->metadata[$email]);
        }
        else {
            $this->metadata = array();
        }
    }

    public function generateId() {
        return rand(0, PHP_INT_MAX);
    }
}
