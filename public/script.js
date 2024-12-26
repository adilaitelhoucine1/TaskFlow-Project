const modal = document.getElementById('modal');
const openModal = document.getElementById('open-modal');
const closeModal = document.getElementById('close-modal');

openModal.addEventListener('click', () => {
  modal.classList.remove('hidden');
});

closeModal.addEventListener('click', () => {
  modal.classList.add('hidden');
});
document.getElementById('type').addEventListener('change', function() {
    const additionalFields = document.getElementById('additionalFields');
    additionalFields.innerHTML = ''; // Réinitialiser les champs supplémentaires
  
    if (this.value === 'bug') {
      additionalFields.innerHTML = `
        <div class="mb-4">
          <label for="urgence" class="block text-sm font-medium text-gray-700 mb-2">Niveau d'Urgence</label>
          <input type="text" id="urgence" name="urgence" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
      `;
    } else if (this.value === 'feature') {
      additionalFields.innerHTML = `
        <div class="mb-4">
          <label for="fonctionnalite" class="block text-sm font-medium text-gray-700 mb-2">Fonctionnalité</label>
          <input type="text" id="fonctionnalite" name="fonctionnalite" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
      `;
    }else if(this.value === 'simple'){
        additionalFields.innerHTML="";
    }
  });
  