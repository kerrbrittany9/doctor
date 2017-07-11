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

        static function getAll()
        {
          $returned_doctors = $GLOBALS['DB']->query("SELECT * FROM doctors;");
          $doctors = array();
          foreach($returned_doctors as $doctor) {
              $name = $doctor['name'];
              $specialty = $doctor['specialty'];
              $id = $doctor['id'];
              $new_doctor = new Doctor($name, $specialty, $id);
              array_push($doctors, $new_doctor);
          }
          return $doctors;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM doctors;");
        }
    }
?>
