<template>
 <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center mb-4">เพิ่มพนักงาน</h2>

        <form @submit.prevent="addEmployees">

          <div class="mb-3">
            <label class="form-label">รหัสพนักงาน</label>
            <input type="text" class="form-control"
              v-model="form.emp_id" placeholder="รหัสพนักงาน" required>
          </div>

          <div class="mb-3">
            <label class="form-label">ชื่อ-นามสกุล</label>
            <input type="text" class="form-control"
              v-model="form.full_name" placeholder="ชื่อ-นามสกุล" required>
          </div>

          <div class="mb-3">
            <label class="form-label">แผนก</label>
            <input type="text" class="form-control"
              v-model="form.department" placeholder="แผนก" required>
          </div>

          <div class="mb-3">
            <label class="form-label">เงินเดือน</label>
            <input type="number" step="0.01" class="form-control"
              v-model="form.salary" placeholder="เงินเดือน" required>
          </div>

          <div class="mb-3">
            <label class="form-label">สถานะ</label>
            <select class="form-control" v-model="form.active">
              <option value="1">ทำงาน</option>
              <option value="0">ลาออก</option>
            </select>
          </div>

          <button type="submit" class="btn btn-primary w-100">
            บันทึก
          </button>

        </form>

        <!-- แสดงผล -->
        <div v-if="message" class="alert mt-3"
             :class="status === 'success' ? 'alert-success' : 'alert-danger'">
          {{ message }}
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
      form: {
        emp_id: '',
        full_name: '',
        department: '',
        salary: '',
        active: '1'
      },
      message: '',
      status: ''
    }
  },
  methods: {
    async addEmployees() {
      try {
        const res = await fetch('http://localhost/project-vue-68701129/php_api/add_employees.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(this.form)
        });

        const result = await res.json();

        this.message = result.message;
        this.status = result.status;

        // เคลียร์ฟอร์ม
        if (result.status === 'success') {
          this.form = {
            emp_id: '',
            full_name: '',
            department: '',
            salary: '',
            active: '1',
          };
        }

      } catch (error) {
        this.message = 'เชื่อมต่อ API ไม่สำเร็จ';
        this.status = 'error';
      }
    }
  }
}
</script>