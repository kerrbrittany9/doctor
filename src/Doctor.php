<?php
    class Doctor
    {
        private $name;
        private $specialty;
        private $id;

        function __construct($name, $specialty, $id = null)
        {
            $this->name = $name;
            $this->specialty = $specialty;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setSpecialty($new_specialty)
        {
            $this->specialty = (string) $new_specialty;
        }

        function getSpecialty()
        {
            return $this->specialty;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO doctors (name, specialty) VALUES ('{$this->getName()}', '{$this->getSpecialty()}');");
            if ($executed) {
                 $this->id= $GLOBALS['DB']->lastInsertId();
                 return true;
            } else {
                 return false;
            }
        }

    }
?>
