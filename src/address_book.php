<?php
class Contact
{
//Properties

    private $name;
    private $phone;
    private $address;
    private $photo;

//Constructor

    function __construct($name, $phone, $address, $photo)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;
        $this->photo = $photo;
    }


//Getter and Setter Methods

    function setName($new_name)
    {
        $this->name = (string) $new_name
    }
    function getName()
    {
        return $this->name;
    }


    function setPhone($new_phone)
    {
        $this->phone = (string) $new_phone;
    }
    function getPhone()
    {
        return $this->phone;
    }


    function setAddress($new_address)
    {
        $this->address = (string) $new_address;
    }
    function getAddress()
    {
        return $this->address;
    }

    function setPhoto($new_photo)
    {
        $this->photo = (string) $new_photo;
    }
    function getPhoto()
    {
        return $this->photo;
    }

//General Methods

    function save()
    {
        array_push($_SESSION['list_of_contacts'], $this);
    }

//Static Methods

    static function getAll()
    {
        return $_SESSION['list_of_contacts'];
    }

    static function deleteAll()
    {
        return $_SESSION['list_of_contacts'] = array();
    }
}
?>
