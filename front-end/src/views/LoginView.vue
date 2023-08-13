<template>
  <div class="container">
    <form @submit.prevent="login">
      <h2 class="mb-3">Iniciar sesión</h2>
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
        ¿No tienes una cuenta? <span @click="moveToRegister">Registro</span>
      </div>
      <button type="submit" class="mt-4 btn-pers" id="login_button">
        Ingresar
      </button>
      <div
        class="alert alert-warning alert-dismissible fade show mt-5 d-none"
        role="alert"
        id="alert_1"
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

<script>
import axios from "axios";

export default {
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    login(submitEvent) {
      this.email = submitEvent.target.elements.email.value;
      this.password = submitEvent.target.elements.password.value;

      axios
        .post("http://127.0.0.1:8000/api/login", {
          email: this.email,
          password: this.password,
        })
        .then((response) => {
          console.log(response);
          localStorage.setItem("token", response.data.token);
          localStorage.setItem(
            "dataUser",
            JSON.stringify([`email: ` + this.email])
          );
          this.$router.push("/dashboard");
        })
        .catch((error) => {
          console.log(error);
        });
    },
    moveToRegister() {
      this.$router.push("/register");
    },
  },
};
</script>
