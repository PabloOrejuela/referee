<?php
    echo
      view('templates/head') 
      .view('templates/header')
        //.view('includes/botonera')
        .view($main_content)
        .view('templates/footer');