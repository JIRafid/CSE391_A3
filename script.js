document.addEventListener('DOMContentLoaded', () => {
    const mechanicSelect = document.getElementById('mechanic');

    // Sample data, replace this with dynamic data from the server
    const mechanics = [
        { id: 1, name: "John Doe", availableSlots: 2 },
        { id: 2, name: "Jane Smith", availableSlots: 4 },
    ];

    // Populate mechanic options
    mechanics.forEach(mechanic => {
        const option = document.createElement('option');
        option.value = mechanic.id;
        option.textContent = `${mechanic.name} (Slots: ${mechanic.availableSlots})`;
        mechanicSelect.appendChild(option);
    });

    // Validate phone number to ensure it's numeric
    document.getElementById('appointment-form').addEventListener('submit', (e) => {
        const phone = document.getElementById('phone').value;
        if (isNaN(phone)) {
            alert("Phone number must be numeric.");
            e.preventDefault();
        }
    });
});
