const nurse = document.getElementById('nurse');
const nurseList = document.getElementById('list-nurse');

const dep = document.getElementById('dep');
const depList = document.getElementById('list-dep');

const form = document.querySelector('form');

const storage = window.localStorage;

const send = async function(data) {
    return await fetch('/controllers/controller.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(res => { return res.json() })
}

if (storage.getItem('shift')) form.shift.value = storage.getItem('shift');
if (storage.getItem('dep')) form.dep.value = storage.getItem('dep');

nurse.onchange = async function() {
    await send({ event: 'nurse', name: this.value })
    .then(res => nurseList.innerHTML = res);
}

dep.onchange = async function() {
    await send({ event: 'dep', dep: this.value })
    .then(res => depList.innerHTML = res);
}

form.find.onclick = async function(e) {
    e.preventDefault();

    if (!form.shift.value || !form.dep.value) return;
    storage.setItem('shift', form.shift.value);
    storage.setItem('dep', form.dep.value);
    await send({ event: 'form', shift: form.shift.value, dep: form.dep.value })
    .then(res => document.getElementById('table').innerHTML = res );
}