<?php

namespace TDM\SwiftMailerEventBundle\Model;

interface MessageMetadataInterface {

    public function addMetadata($email, array $metadata);

    public function setMetadata($email, $key, $value);

    public function hasMetadata($email, $key = null);

    public function getMetadata($email = null, $key = null);

    public function clearMetadata($email = null);

}