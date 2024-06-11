<?php
  class Monitor {
    public $folder;
    public $cpu;

    public function __construct($folder, $cpu) {
      $this->folder = $folder;
      $this->cpu = $cpu;
    }

    public function __toString() {
      return '<span class="fw-bold">Machine hôte :</span> ' . shell_exec("cat " . $this->cpu)
      . '<br /><span class="fw-bold">Espace disque disponible :</span> ' . disk_free_space($this->folder). ' octets
      <br /><span class="fw-bold">Utilisation actuelle de la mémoire :</span> ' . memory_get_usage();
    }
  }
?>