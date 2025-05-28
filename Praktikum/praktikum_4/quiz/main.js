let sudahUlang = false;

window.onload = function () {
  // Cek localStorage dan tampilkan data kalau ada
  const rata = localStorage.getItem("rata");
  const status = localStorage.getItem("status");
  const grade = localStorage.getItem("grade");

  if (rata && status && grade) {
    let warna;
    if (grade === "A") warna = "green";
    else if (grade === "B") warna = "orange";
    else warna = "red";

    const hasilDiv = document.getElementById("hasilQuiz");
    hasilDiv.innerHTML = `
      Rata-rata: ${rata}<br>
      Status: ${status}<br>
      Grade: ${grade}
    `;
    hasilDiv.style.color = warna;
  }
};

function mulaiQuiz() {
  if (sudahUlang) {
    localStorage.clear();
    document.getElementById("hasilQuiz").innerHTML = "";
    sudahUlang = false;
  }

  let uts = prompt("Masukkan nilai UTS:");
  if (uts === null) return;

  let uas = prompt("Masukkan nilai UAS:");
  if (uas === null) return;

  let tugas = prompt("Masukkan nilai Tugas:");
  if (tugas === null) return;

  if (!isAngkaValid(uts) || !isAngkaValid(uas) || !isAngkaValid(tugas)) {
    alert("Semua input harus berupa angka antara 0 - 100.");
    return;
  }

  uts = parseFloat(uts);
  uas = parseFloat(uas);
  tugas = parseFloat(tugas);

  const values = [uts, uas, tugas];
  const rata = hitungRata(values);
  tampilHasil(rata, uts, uas, tugas);
}

function isAngkaValid(nilai) {
  const angka = parseFloat(nilai);
  return !isNaN(angka) && angka >= 0 && angka <= 100;
}

function hitungRata(valuesArray) {
  const total = valuesArray.reduce((acc, val) => acc + val, 0);
  return parseFloat((total / valuesArray.length).toFixed(2));
}

function tampilHasil(rata, uts, uas, tugas) {
  let status, grade, warna;

  if (rata >= 80) {
    grade = 'A';
    status = 'Lulus';
    warna = 'green';
  } else if (rata >= 60) {
    grade = 'B';
    status = 'Remedial';
    warna = 'orange';
  } else {
    grade = 'C';
    status = 'Tidak Lulus';
    warna = 'red';
  }

  localStorage.setItem("uts", uts);
  localStorage.setItem("uas", uas);
  localStorage.setItem("tugas", tugas);
  localStorage.setItem("rata", rata);
  localStorage.setItem("status", status);
  localStorage.setItem("grade", grade);

  const hasilDiv = document.getElementById("hasilQuiz");
  hasilDiv.innerHTML = `
    Rata-rata: ${rata}<br>
    Status: ${status}<br>
    Grade: ${grade}
  `;
  hasilDiv.style.color = warna;
}

function ulangQuiz() {
  localStorage.clear();
  document.getElementById("hasilQuiz").innerHTML = "";
  sudahUlang = true;
}
