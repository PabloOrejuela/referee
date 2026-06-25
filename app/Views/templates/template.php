<?php
    echo
      view('templates/head') 
      .view('templates/header')
        .view('templates/sidemenu')
        .view($main_content)
        .view('templates/footer');