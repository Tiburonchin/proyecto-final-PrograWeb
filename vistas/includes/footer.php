<!-- SCRIPTS PARA EL FUNCIONAMINETO DE BOOTSRAP Y DEMÁS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- Font Awesome para iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Footer -->
<footer class="footer mt-auto bg-dark text-white pt-4">
  <div class="container">
    <div class="row">
      <!-- Columna 1: Sobre Nosotros -->
      <div class="col-md-4 mb-4">
        <h5 class="text-uppercase font-weight-bold mb-4">
          <i class="fas fa-dumbbell mr-2"></i>Gimnasio Virtual
        </h5>
        <p>Tu salud y bienestar son nuestra prioridad. Únete a nuestra comunidad fitness y alcanza tus metas con nosotros.</p>
        <div class="mt-3">
          <a href="#" class="text-white mr-2"><i class="fas fa-phone-alt"></i> +51 123 456 789</a><br>
          <a href="mailto:info@gimnasiovirtual.com" class="text-white"><i class="fas fa-envelope"></i> info@gimnasiovirtual.com</a>
        </div>
      </div>

      <!-- Columna 2: Enlaces Rápidos -->
      <div class="col-md-4 mb-4">
        <h5 class="text-uppercase font-weight-bold mb-4">Enlaces Rápidos</h5>
        <ul class="list-unstyled">
          <li class="mb-2">
              <a href="?controller=index&accion=index" class="text-white"><i class="fas fa-chevron-right mr-2"></i>Inicio</a>
          </li>
          <li class="mb-2">
              <a href="?controller=index&accion=verActividades" class="text-white"><i class="fas fa-chevron-right mr-2"></i>Clases</a>
          </li>
          <li class="mb-2">
              <a href="?controller=index&accion=listarHorario" class="text-white"><i class="fas fa-chevron-right mr-2"></i>Horario</a>
          </li>
          <li class="mb-2">
              <a href="#" class="text-white" data-toggle="modal" data-target="#contactoModal"><i class="fas fa-chevron-right mr-2"></i>Contacto</a>
()          </li>
        </ul>
      </div>

      <!-- Columna 3: Redes Sociales -->
      <div class="col-md-4 mb-4">
        <h5 class="text-uppercase font-weight-bold mb-4">Síguenos</h5>
        <p>Conéctate con nosotros en nuestras redes sociales</p>
        <div class="social-links">
          <a href="https://www.facebook.com/edgaralexis.ramostrujillo" class="text-white mr-3"><i class="fab fa-facebook-f fa-lg"></i></a>
          <a href="#" class="text-white mr-3"><i class="fab fa-twitter fa-lg"></i></a>
          <a href="https://www.instagram.com/ealexis_rt/" class="text-white mr-3"><i class="fab fa-instagram fa-lg"></i></a>
          <a href="#" class="text-white mr-3"><i class="fab fa-youtube fa-lg"></i></a>
          <a href="#" class="text-white"><i class="fab fa-linkedin-in fa-lg"></i></a>
        </div>
        
        <div class="mt-4">
          <h6 class="text-uppercase font-weight-bold mb-3">Enlaces Importantes</h6>
          <a href="https://github.com/Tiburonchin/proyecto-final-PrograWeb" target="_blank" class="text-white d-block mb-2">
            <i class="fab fa-github mr-2"></i> Código en GitHub
          </a>
          <a href="https://sga.unac.edu.pe/security/Login_FS.html" target="_blank" class="text-white d-block">
            <i class="fas fa-university mr-2"></i> UNAC
          </a>
        </div>
      </div>
    </div>

    <hr class="bg-light">
    
    <!-- Copyright -->
    <div class="text-center py-3">
      <p class="mb-0"> 2025 Gimnasio Virtual. Todos los derechos reservados.</p>
      <p class="mb-0 small">Desarrollado por Edgar Ramos Trujillo & Bryan Porras Aurelio</p>
    </div>
  </div>
</footer>

<!-- Estilos adicionales para el footer -->
<style>
  .footer a {
    color: #fff;
    text-decoration: none;
    transition: all 0.3s ease;
  }
  .footer a:hover {
    color: #00c853;
    text-decoration: none;
  }
  .social-links a {
    display: inline-block;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.1);
    text-align: center;
    line-height: 35px;
    margin-right: 8px;
    transition: all 0.3s ease;
  }
  .social-links a:hover {
    background-color: #00c853;
    transform: translateY(-3px);
  }
  .footer h5 {
    position: relative;
    padding-bottom: 10px;
  }
  .footer h5:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 50px;
    height: 2px;
    background-color: #00c853;
  }
</style>

<!-- Modal de Contacto -->
<div class="modal fade" id="contactoModal" tabindex="-1" role="dialog" aria-labelledby="contactoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-dark text-white">
      <div class="modal-header border-secondary">
        <h5 class="modal-title" id="contactoModalLabel"><i class="fas fa-envelope mr-2"></i>Contáctanos</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="mb-4">
          <h6 class="text-uppercase text-success mb-3">Información de Contacto</h6>
          <p><i class="fas fa-phone-alt mr-2"></i> +51 123 456 789</p>
          <p><i class="fas fa-envelope mr-2"></i> info@gimnasiovirtual.com</p>
          <p><i class="fas fa-map-marker-alt mr-2"></i> Av. Principal 123, Lima, Perú</p>
        </div>
        <hr class="bg-secondary">
        <div class="mt-4">
          <h6 class="text-uppercase text-success mb-3">Horario de Atención</h6>
          <p>Lunes a Viernes: 6:00 AM - 10:00 PM</p>
          <p>Sábados: 8:00 AM - 8:00 PM</p>
          <p>Domingos: 9:00 AM - 2:00 PM</p>
        </div>
      </div>
      <div class="modal-footer border-secondary">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
        <a href="mailto:info@gimnasiovirtual.com" class="btn btn-success">
          <i class="fas fa-paper-plane mr-2"></i>Enviar Correo
        </a>
      </div>
    </div>
  </div>
</div>