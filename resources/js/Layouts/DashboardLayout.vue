<script setup>
 
import Header from '../Components/Header.vue';
import Sidebar from '../Components/Sidebar.vue';

</script>

<template>
    <section class="section ticto">
       <div class="container">
          <Header></Header>
          <div class="columns">
 
             <!-- Menu lateral -->
              <Sidebar></Sidebar>
 
             <!-- Conteúdo -->
             <div class="column is-9">
                <slot></slot>
             </div>
 
          </div>
       </div>
    </section>
 </template>

<style>

.ticto .box {
   min-height: 660px;
}

</style>