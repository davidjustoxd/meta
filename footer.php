<div class="navbar" style="overflow: hidden;
  background-color: #333;
  justify-content: space-around;
  position: fixed; /* Set the navbar to fixed position */
  bottom: 0; /* Position the navbar at the top of the page */
  width: 100%; /* Full width */
  min-height:7%;
  text-transform: uppercase;">
    <a href="pp.php">política de privacidad</a>
    <a href="contacto.php">Contacto</a>
    <a href="aboutmeta.php">Sobre Meta</a>
    <?php if ($esAdmin == 1) {
        echo "<a href='management1.php'>Administrar usuarios </a>";
    } ?>
</div>
</div>
</body>
</html>
