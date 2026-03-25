<template>
  <div class="register-container">
    <div class="register-box">
      <h1>Register</h1>
      <form @submit.prevent="submitForm">
        <div class="form-group">
          <label for="name">ชื่อ-นามสกุล</label>
          <input
            v-model="form.name"
            type="text"
            id="name"
            placeholder="Enter your full name"
            required
          />
        </div>

        <div class="form-group">
          <label for="email">อีเมล</label>
          <input
            v-model="form.email"
            type="email"
            id="email"
            placeholder="Enter your email"
            required
          />
        </div>

        <div class="form-group">
          <label for="password">รหัสผ่าน</label>
          <input
            v-model="form.password"
            type="password"
            id="password"
            placeholder="Enter your password"
            required
          />
        </div>

        <div class="form-group">
          <label for="confirm-password">ยืนยันรหัสผ่าน</label>
          <input
            v-model="form.confirmPassword"
            type="password"
            id="confirm-password"
            placeholder="Confirm your password"
            required
          />
        </div>

        <button type="submit" class="submit-btn">ลงทะเบียน</button>
      </form>

      <p class="login-link">
        Already have an account? <router-link to="/login">Login here</router-link>
      </p>

      <div v-if="message" :class="['message', messageType]">
        {{ message }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Register',
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        confirmPassword: ''
      },
      message: '',
      messageType: ''
    };
  },
  methods: {
    submitForm() {
      if (this.form.password !== this.form.confirmPassword) {
        this.message = 'Passwords do not match!';
        this.messageType = 'error';
        return;
      }

      // TODO: Send registration data to backend API
      console.log('Registration data:', this.form);
      this.message = 'Registration successful!';
      this.messageType = 'success';

      // Reset form after successful registration
      setTimeout(() => {
        this.resetForm();
        this.$router.push('/');
      }, 2000);
    },
    resetForm() {
      this.form = {
        name: '',
        email: '',
        password: '',
        confirmPassword: ''
      };
      this.message = '';
      this.messageType = '';
    }
  }
};
</script>

<style scoped>
.register-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  padding: 20px;
}

.register-box {
  background: white;
  padding: 40px;
  border-radius: 10px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
  width: 100%;
  max-width: 400px;
}

h1 {
  text-align: center;
  color: #333;
  margin-bottom: 30px;
  font-size: 28px;
}

.form-group {
  margin-bottom: 20px;
}

label {
  display: block;
  margin-bottom: 8px;
  color: #555;
  font-weight: 600;
  font-size: 14px;
}

input {
  width: 100%;
  padding: 12px;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 14px;
  transition: border-color 0.3s;
  box-sizing: border-box;
}

input:focus {
  outline: none;
  border-color: #667eea;
  box-shadow: 0 0 5px rgba(102, 126, 234, 0.1);
}

.submit-btn {
  width: 100%;
  padding: 12px;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: transform 0.2s, box-shadow 0.2s;
  margin-top: 10px;
}

.submit-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}

.submit-btn:active {
  transform: translateY(0);
}

.login-link {
  text-align: center;
  margin-top: 20px;
  color: #666;
  font-size: 14px;
}

.login-link a {
  color: #667eea;
  text-decoration: none;
  font-weight: 600;
}

.login-link a:hover {
  text-decoration: underline;
}

.message {
  margin-top: 20px;
  padding: 12px;
  border-radius: 5px;
  text-align: center;
  font-size: 14px;
  font-weight: 600;
}

.message.success {
  background-color: #d4edda;
  color: #155724;
  border: 1px solid #c3e6cb;
}

.message.error {
  background-color: #f8d7da;
  color: #721c24;
  border: 1px solid #f5c6cb;
}
</style>
