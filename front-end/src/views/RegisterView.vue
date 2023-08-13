<template>
  <div class="container">
    <form @submit.prevent="register">
      <h2 class="mb-3">Resgitro</h2>
      <div class="input">
        <label for="email">Correo electrónico</label>
        <input
          class="form-control"
          type="text"
          name="email"
          placeholder="email@adress.com"
        />
      </div>
      <div class="input">
        <label for="password">Contraseña</label>
        <input
          class="form-control"
          type="password"
          name="password"
          placeholder="password123"
        />
      </div>

      <div class="alternative-option mt-4">
        ¿Ya tienes una cuenta? <span @click="moveToLogin">Ingresar</span>
      </div>

      <button type="submit" id="register_button" class="mt-4 btn-pers">
        Registrar
      </button>
      <div
        class="alert alert-warning alert-dismissible fade show mt-5 d-none"
        role="alert"
        id="alert_2"
      >
        Lorem ipsum dolor sit amet consectetur, adipisicing elit.
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="alert"
          aria-label="Close"
        ></button>
      </div>
    </form>
  </div>
</template>
