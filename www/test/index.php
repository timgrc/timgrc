<form id="form" method="POST" action="envoi.php" >
    <p>
      <label for="nom"></label>
      <input  required type="text"  name="name" id="name" placeholder="Votre nom" value="" />

    </p>
    <p>
      <label for="email"></label>
      <input  required type="text" name="email" id="email" placeholder="Votre Email" value="">

    </p>
    <p>
      <label for="objet"></label>
      <input required type="text" name="objet" id="objet" placeholder="Objet" value="">

    </p>
    <p>
      <label for="message"></label>
      <textarea required name="message" id="message" placeholder="Votre message"></textarea>
    </p>
      <button type="submit" class="button-envoyer">Envoyer</button>
</form>
