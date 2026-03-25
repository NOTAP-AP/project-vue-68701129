<template>
    <div class="container my-5">
        <h2>แสดงข้อมูลลูกค้า</h2>
        <table class="table">
  <thead>
    <tr class="table table-dark table-primary">
      <th>รหัสลูกค้า</th>
      <th>ชื่อ</th>
      <th>นามสกุล</th>
      <th>เบอร์โทรศัพท์</th>
      <th>Username</th>
    </tr>
  </thead>

  <tbody>
    <tr v-for="item in customer" :key="customer_id">
      <td>{{ item.customer_id }}</td>
      <td>{{item.firstName}}</td>
      <td>{{item.lastName}}</td>
      <td>{{item.phone}}</td>
      <td>{{item.username}}</td>
        </tr>
  </tbody>
</table>
    </div>
</template>
<script setup>
import { ref, onMounted } from 'vue'

const customer = ref([])
const loading = ref(true)
const error = ref(null)

onMounted(async () => {
  try {
    const res = await fetch('http://localhost/project-vue-68701129/php_api/show_customer.php')
    customer.value = await res.json()
    //products.value = data.products
  } catch (err) {
    error.value = 'โหลดข้อมูลไม่สำเร็จ'
  } finally {
    loading.value = false
  }
})
</script>