<template>
  <div class="container" style="opacity: 0.95">
    <div class="row justify-content-md-center">
      <div class="col-6">
        <div class="card card-default">
          <div class="card-header">Login</div>
          <span class="alert alert-danger text-center mt-3" v-if="has_error && !success">
              Email atau password salah!
            </span>
          <div class="card-body">
            
            <form autocomplete="off" @submit.prevent="login" method="post">
              <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" v-model="email" required="">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="password" required="">
              </div>
              <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Sign In</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        email: null,
        password: null,
        success: false,
        has_error: false,
        error: ''
      }
    },
    mounted() {
      //
    },
    methods: {
      login() {
        // get the redirect object
        var redirect = this.$auth.redirect()
        var app = this
        this.$auth.login({
          data: {
            email: app.email,
            password: app.password
          },
          success: function() {
            // handle redirection
            app.success = true
            const redirectTo = 'dashboard'
            this.$router.push({name: redirectTo})
          },
          error: function() {
            app.has_error = true
            app.error = res.response.data.error
          },
          rememberMe: true,
          fetchUser: true
        })
      }
    }
  }
</script>