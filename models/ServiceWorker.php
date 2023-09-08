<?php
    class ServiceWorker {
        private int $id;
        private string $sw_endpoint;
        private string $auth;
        private string $p256dh;
        private int $id_gestor;
        
        public function __construct(int $id, string $sw_endpoint, string $auth, string $p256dh, int $id_gestor) {
            $this->id = $id;
            $this->sw_endpoint = $sw_endpoint;
            $this->auth = $auth;
            $this->p256dh = $p256dh;
            $this->id_gestor = $id_gestor;
        }
        
        public function getId(): int {
            return $this->id;
        }
        
        public function getSwEndpoint(): string {
            return $this->sw_endpoint;
        }
        
        public function setSwEndpoint(string $sw_endpoint): void {
            $this->sw_endpoint = $sw_endpoint;
        }
        
        public function getAuth(): string {
            return $this->auth;
        }
        
        public function setAuth(string $auth): void {
            $this->auth = $auth;
        }
        
        public function getP256dh(): string {
            return $this->p256dh;
        }
        
        public function setP256dh(string $p256dh): void {
            $this->p256dh = $p256dh;
        }
        public function getIdGestor(): int {
          return $this->id_gestor;
        }
        public function setIdGestor($id_gestor): void {
          $this->id_gestor = $id_gestor;
      }
    }
?>