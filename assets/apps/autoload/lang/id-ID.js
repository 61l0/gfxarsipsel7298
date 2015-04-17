'use strict';

var i18n = {
    language: {
        "ask_fund"                : "<i class='fa fa-share'></i> Ask For Fund",
        "give_fund"                : "<i class='fa fa-reply'></i> Give Fund",
        "assignment"                : "<i class='fa fa-reorder'></i> Assignment",
        "my_fund_act"                : "<i class='fa fa-bar-chart'></i> My Fund Activity",
        "bonus_statement"                : "<i class='fa fa-credit-card'></i> Bonus Statement",
        "gf_history"                : "<i class='fa fa-globe'></i> GF History",
        "af_history"                : "<i class='fa fa-globe'></i> AF History",

        "my_coupon"                : "<i class='fa fa-file-text-o'></i> My Coupon",

        "account_detail"                : "<i class='fa fa-male'></i> Account Details",
        "account_setting"                : "<i class='fa fa-cog'></i> Account Settings",
        "change_password"                : "<i class='fa fa-key'></i> Ganti Password",
        "change_pin"                : "<i class='fa fa-credit-card'></i> Ganti PIN",
        "profile_picture"                : "<i class='fa fa-file-image-o'></i> Foto Profil",


        "member"                : "<i class='fa fa-home'></i> Member Home",
        "myAccount"                : "<i class='fa fa-user'></i> Akun Saya",
        "network"                : "<i class='fa fa-sitemap'></i> Jaringan",
        "funds"                : "<i class='fa fa-money'></i> Funds",
        "registration"                : "<i class='fa fa-user'></i> Registrasi",
        "ticket"                : "<i class='fa fa-file-text-o'></i> Tiket",
        "mytiket"                : "<i class='fa fa-file-text-o'></i> My Tiket",
        "covertiket"                : "<i class='fa fa-file-text-o'></i> Convert Tiket",

        "name"                  : "<img class='lg-sm' src='assets/img/lg-sm.png' alt='Bersama Laba'/>",
    
        "id"                    : "ID",
        "home"                  : "<i class='fa fa-home'></i> Beranda",
        "view"                  : "Lihat",
        "view_details"          : "Lihat Detil",
        "edit"                  : "Edit",
        "create"                : "Tambah",
        "read"                  : "Lihat",
        "update"                : "Ubah",
        "delete"                : "Hapus",
        "save"                  : "Simpan",
        "save_and_close"        : "Simpan & Tutup",
        "close_without_saving"  : "Batal",
        "close"                 : "Tutup",
    
        "login"                 : "<i class='fa fa-lock'></i> Login",
        "logout"                : "<i class='fa fa-power-off'></i> Keluar",
        "register"              : "<i class='fa fa-user'></i> Register",
        "sign_in"               : "Masuk",
        "sign_up"               : "Register",
        "email"                 : "Email",
        "password"              : "Password",
        "confirm_password"      : "Ulangi Password",
    
        "are_you_sure"          : "Apakah anda yakin ?",
        "fill_out_login"        : "Silahkan lengkapi data anda.",
        "you_may_login"         : "Sekarang anda sudah bisa login.",
        "passwords_not_match"   : "Password tidak sama.",
    
        "toggle_nav"            : "Tampilkan/Sembunyikan Navigasi",
        "admin_panel"           : "<img class='lg-sm' src='assets/img/lg-sm.png' alt='Bersama Laba'/>",
        "search"                : "Cari...",
        "dashboard"             : "Beranda",
        "view_frontend"         : "Lihat Website",
        "settings"              : "Pengaturan",
    
        "users"                 : "Pengguna",
        "user_updated"          : "Pengguna berhasil di ubah.",
        "user_profile"          : "Profil Pengguna",
        "view_user"             : "Lihat Pengguna",
        "edit_user"             : "Ubah Pengguna",
    
        "role"                  : "Role",
        "roles"                 : "Roles",
        "add_role"              : "Tambah Role",
        "view_role"             : "Lihat Role",
        "edit_role"             : "Ubah Role",
        "enter_role_name"       : "Masukkan nama role.",
        "role_added"            : "Role berhasil ditambahkan.",
        "role_deleted"          : "Role berhasil dihapus.",
        "role_updated"          : "Role berhasil diubah.",
        "role_name"             : "Nama Role ...",
    
        "resource"              : "Resource",
    
        "new_comments"          : "New Comments!",
        "new_tasks"             : "New Tasks!",
        "new_orders"            : "New Orders!",
        "support_tickets"       : "Support Tickets!",

        "required"              : "The %s field is required.",
        "isset"                 : "The %s field must have a value.",
        "valid_email"           : "The %s field must contain a valid email address.",
        "valid_emails"          : "The %s field must contain all valid email addresses.",
        "valid_url"             : "The %s field must contain a valid URL.",
        "valid_ip"              : "The %s field must contain a valid IP.",
        "min_length"            : "The %s field must be at least %s characters in length.",
        "max_length"            : "The %s field can not exceed %s characters in length.",
        "exact_length"          : "The %s field must be exactly %s characters in length.",
        "alpha"                 : "The %s field may only contain alphabetical characters.",
        "alpha_numeric"         : "The %s field may only contain alpha-numeric characters.",
        "alpha_dash"            : "The %s field may only contain alpha-numeric characters, underscores, and dashes.",
        "numeric"               : "The %s field must contain only numbers.",
        "is_numeric"            : "The %s field must contain only numeric characters.",
        "integer"               : "The %s field must contain an integer.",
        "regex_match"           : "The %s field is not in the correct format.",
        "matches"               : "The %s field does not match the %s field.",
        "is_unique"             : "The %s field must contain a unique value.",
        "is_natural"            : "The %s field must contain only positive numbers.",
        "is_natural_no_zero"    : "The %s field must contain a number greater than zero.",
        "decimal"               : "The %s field must contain a decimal number.",
        "less_than"             : "The %s field must contain a number less than %s.",
        "greater_than"          : "The %s field must contain a number greater than %s.",
        
        "invalid"               : "Kombinasi Username/Email dan password yang anda masukkan tidak valid.",
        "access"                : "Anda tidak memiliki akses untuk resource ini.",
        "unathenticated"        : "Anda harus login dulu.",
        "wrong_oldpass"         : "Old password is wrong !",
        "wrong_oldpin"         : "Old PIN is wrong !",
        "wrong_user"         : "User doesnt exist !",
        "changepass_success"    : "Change Password Success !",
        "changepin_success"    : "Change PIN Success !",
        'bank'                  : "<i class='fa fa-bank'></i> Daftar Bank",
        'nama_bank'                  : "Nama Bank",
        "edit_bank"             : "Ubah Data Bank",
        "view_bank"             : "Lihat Data Bank",
        "bank_deleted"          : "Data Bank berhasil dihapus",
        "bank_updated"          : "Data Bank berhasil diubah",
        'keterangan'                  : "Keterangan",

    },
    s: function(key, value) {
      return this.language[key].replace('%s', value);
    },
    t: function(key) {
      return this.language[key];
    },
    printf : function(key) {
        function parse(str) {
            var args = [].slice.call(arguments, 1),i = 0;
            return str.replace(/%s/g, function() {
                return args[i++];
            });
        } 
        return parse( this.language[key],arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]);
    }
};

App.injectLanguages(i18n);