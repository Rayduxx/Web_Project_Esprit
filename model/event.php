<?php 
    class event{
        private int $id;
        private string $name;
        private int $datetime;
        private int $maxParticipant;
        private int $participant;
        private int $iscomplete;
        private string $image;
        private string $image2;
        private string $image3;
        private string $image4;
        private string $description;
        public function __construct($ID, $nom, $DTime, $maxP, $Par, $isC, $img, $img2, $img3, $img4, $desc){
            $this->id =$ID;
            $this->name=$nom;
            $this->datetime=$DTime;
            $this->maxParticipant=$maxP;
            $this->participant=$Par;
            $this->iscomplete=$isC;
            $this->image=$img;
            $this->image2=$img2;
            $this->image3=$img3;
            $this->image4=$img4;
            $this->description=$desc;
        }
        public function getEventId (){
            return  $this->id;
        }
        public function getEventName(){
            return $this->name;
        }
        public function getEventDateTime(){
            return $this->datetime;
        }
        public function getMaxParticipant(){
            return $this->maxParticipant;
        }
        public function getParticipant () {
            return $this->participant;
        }
        public function getiSComplete(){
            return $this->iscomplete;
        }
        public function getEventImage(){
            return $this->image;
        }
        public function getEventImageTwo(){
            return $this->image2;
        }
        public function getEventImagethree(){
            return $this->image3;
        }
        public function getEventImagefour(){
            return $this->image4;
        }
        public function getEventdescription(){
            return $this->description;
        }

    }

    class EventLog {
        private int $id;
        private int $eventId;
        private int $userId;
        private int $dateInscription;
        public function __construct($ID, $eventI, $UserI, $dateI){
            $this->id =$ID;
            $this->eventId=$eventI;
            $this->UserId=$UserI;
            $this->dateInscription=$dateI;
        }
        public function getEventLogID(){
            return $this->id;
        }
        public function getEventLogEventId(){
            return $this->eventId;
        }
        public function getEventLogUserId(){
            return $this->UserId;
        }
        public function getEventLogDateInscription(){
            return  $this->dateInscription;
        }
    }










?>