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

        static function find($search_id)
      {
          $found_doctor = null;
          $returned_doctors = $GLOBALS['DB']->prepare("SELECT * FROM doctors WHERE id = :id");
          $returned_doctors->bindParam(':id', $search_id, PDO::PARAM_STR);
          $returned_doctors->execute();
          foreach($returned_doctors as $doctor) {
              $doctor_name = $doctor['name'];
              $specialty = $doctor['specialty'];
              $doctor_id = $doctor['id'];
              if ($doctor_id == $search_id) {
                $found_doctor = new Doctor($doctor_name, $specialty, $doctor_id);
              }
          }
          return $found_doctor;
      }

        function getPatients()
        {
            $patients = array();
            $returned_patients = $GLOBALS['DB']->query("SELECT * FROM patients WHERE doctor_id = {$this->getId()};");
            foreach($returned_patients as $patient) {
                $patient_name = $patient['name'];
                $dob = $patient['birthday'];
                $doctor_id = $patient['doctor_id'];
                $patient_id = $patient['id'];
                $new_patient = new Patient($patient_name, $dob, $doctor_id, $patient_id);
                array_push($patients, $new_patient);
            }
            return $patients;
        }
    }
?>
