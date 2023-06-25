<div class="text-center login site-font-color my-auto">

  <img class="mt-4 " src="https://icons.iconarchive.com/icons/iconka/business-finance/256/handshake-icon.png"
    height="144" alt="Logo">
  <h1 class=" h1 mb-3 "><?php echo $text1 ?></h1>
  <h1 class=" h6 mb-3 "><?php echo $text2 ?></h1>
  <h1 class=" h3 mb-3 ">You will be Redirected in <span class="count">5</span> Seconds
    <?php echo $destination ?>
  </h1>
  <h1 class=" h6 mb-3 ">Click here <a class="site-font-color"
      href="<?php echo $destinationPage ?>">here</a>,if you are not Redirected </h1>

  <script>
    // Javascript for the countdown
    var countElement = document.querySelector('.count');
    var count = 5;

    var handler = () => {
      countElement.innerHTML = count--;
      if (count == 0) clearInverval(timer);
    };

    var timer = setInterval(handler, 1000);
  </script>

</div>