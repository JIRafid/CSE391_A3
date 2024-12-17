document.addEventListener('DOMContentLoaded', () => {
    const mechanicSelect = document.getElementById('mechanic');




    mechanics.forEach(mechanic => {
        const option = document.createElement('option');
        option.value = mechanic.id;
        option.textContent = `${mechanic.name} (Slots: ${mechanic.availableSlots})`;
        mechanicSelect.appendChild(option);
    });

    document.getElementById('appointment-form').addEventListener('submit', (e) => {
        const phone = document.getElementById('phone').value;
        if (isNaN(phone)) {
            alert("Phone number must be numeric.");
            e.preventDefault();
        }
    });
});

