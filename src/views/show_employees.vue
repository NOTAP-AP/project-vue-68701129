<template>
    <div class="container my-5">
        <h2>แสดงข้อมูลลูกค้า</h2>
        <table class="table">
  <thead>
    <tr class="table table-dark table-primary">
      <th>รหัสพนักงาน</th>
      <th>ชื่อ-นามสกุล</th>
      <th>แผนก</th>
      <th>เงินเดือน</th>
      <th>สถานะ</th>
      <th>วันเวลาทำการ</th>
    </tr>
  </thead>

  <tbody>
    <tr v-for="item in employees" :key="emp_id">
      <td>{{ item.emp_id }}</td>
      <td>{{item.full_name}}</td>
      <td>{{item.department}}</td>
      <td>{{item.salary}}</td>
      <td><span v-if="item.active==1">ปกติ</span>
        <span v-else>ลาออก</span></td>
      <td>{{item.created_at}}</td>
        
        </tr>
  </tbody>
</table>
    </div>
</template>
<script setup>
import { ref, onMounted } from 'vue'

const employees = ref([])
const loading = ref(true)
const error = ref(null)

onMounted(async () => {
  try {
    const res = await fetch('http://localhost/project-vue-68701129/php_api/show_employees.php')
    employees.value = await res.json()
    //products.value = data.products
  } catch (err) {
    error.value = 'โหลดข้อมูลไม่สำเร็จ'
  } finally {
    loading.value = false
  }
})
</script>