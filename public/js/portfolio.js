document.addEventListener('DOMContentLoaded', function() {
    let galleryIndex = 1;
    let skillIndex = 1;
    let experienceIndex = 1;
    let educationIndex = 1;

    document.getElementById("add-education").addEventListener("click", function() {
        const container = document.getElementById("educations");
        const educationDiv = document.createElement('div');
        educationDiv.classList.add('education');
        
        educationDiv.innerHTML = `
            <label for="educations_date_${educationIndex}">Date</label>
            <input type="date" name="educations_date[]" id="educations_date_${educationIndex}" required />
            
            <label for="educations_description_${educationIndex}">Description</label>
            <textarea name="educations_description[]" id="educations_description_${educationIndex}" placeholder="Describe your education" required></textarea>

            <button type="button" class="remove-item" id="remove-education-${educationIndex}">Delete ✖</button>
        `;
        
        container.appendChild(educationDiv);
        educationIndex++;

        document.getElementById(`remove-education-${educationIndex - 1}`).addEventListener("click", function() {
            container.removeChild(educationDiv);
        });
    });

    document.getElementById("add-skill").addEventListener("click", function() {
        const container = document.getElementById("skills");
        const skillDiv = document.createElement('div');
        skillDiv.classList.add('skill');
        skillDiv.innerHTML = `
            <label for="skills_title_${skillIndex}">Title</label>
            <input type="text" name="skills_title[]" id="skills_title_${skillIndex}" placeholder="Skill title (e.g., Web Development)" required />
            
            <label for="skills_description_${skillIndex}">Description</label>
            <textarea name="skills_description[]" id="skills_description_${skillIndex}" placeholder="Brief description of the skill"></textarea>

            <button type="button" class="remove-item" id="remove-skill-${skillIndex}">Delete ✖</button>
        `;
        container.appendChild(skillDiv);
        skillIndex++;

        // إضافة حدث الحذف
        document.getElementById(`remove-skill-${skillIndex - 1}`).addEventListener("click", function() {
            container.removeChild(skillDiv);
        });
    });

    document.getElementById("add-experience").addEventListener("click", function() {
        const container = document.getElementById("experiences");
        const experienceDiv = document.createElement('div');
        experienceDiv.classList.add('experience');
        experienceDiv.innerHTML = `
            <label for="experiences_date_${experienceIndex}">Date</label>
            <input type="date" name="experiences_date[]" id="experiences_date_${experienceIndex}" required />
            
            <label for="experiences_description_${experienceIndex}">Description</label>
            <textarea name="experiences_description[]" id="experiences_description_${experienceIndex}" placeholder="Describe your experience" required></textarea>

            <button type="button" class="remove-item" id="remove-experience-${experienceIndex}">Delete ✖</button>
        `;
        container.appendChild(experienceDiv);
        experienceIndex++;

        document.getElementById(`remove-experience-${experienceIndex - 1}`).addEventListener("click", function() {
            container.removeChild(experienceDiv);
        });
    });

    // إضافة المعارض
    document.getElementById("add-gallery").addEventListener("click", function() {
        const container = document.getElementById("galleries");
        const galleryDiv = document.createElement('div');
        galleryDiv.classList.add('gallery');
        
        galleryDiv.innerHTML = `
            <label for="galleries_title_${galleryIndex}">Title</label>
            <input type="text" name="galleries[${galleryIndex}][title]" id="galleries_title_${galleryIndex}" placeholder="Gallery title" required />
            
            <label for="galleries_platform_${galleryIndex}">Platform</label>
            <select name="galleries[${galleryIndex}][platform]" id="galleries_platform_${galleryIndex}" required>
                <option value="" disabled selected>Select Platform</option>
                <option value="GitHub">GitHub</option>
                <option value="Behance">Behance</option>
                <option value="Dribbble">Dribbble</option>
                <option value="LinkedIn">LinkedIn</option>
                <option value="Instagram">Instagram</option>
                <option value="ArtStation">ArtStation</option>
                <option value="Figma">Figma</option>
                <option value="Sketchfab">Sketchfab</option>
                <option value="Pinterest">Pinterest</option>
            </select>
            
            <label for="galleries_link_${galleryIndex}">Link</label>
            <input type="url" name="galleries[${galleryIndex}][link]" id="galleries_link_${galleryIndex}" placeholder="Gallery link" required />
            
            <label for="galleries_thumbnail_${galleryIndex}">Thumbnail</label>
            <input type="file" name="galleries[${galleryIndex}][thumbnail]" id="galleries_thumbnail_${galleryIndex}" accept="image/*" required />
            
            <button type="button" class="remove-item" id="remove-gallery-${galleryIndex}">Delete ✖</button>
        `;
        container.appendChild(galleryDiv);
        galleryIndex++;
        document.getElementById(`remove-gallery-${galleryIndex - 1}`).addEventListener("click", function() {
            container.removeChild(galleryDiv);
        });
    });
});
//=======================================================
// التبديل بين التبويبات
// Toggle Navbar for Mobile





// JavaScript لتفعيل التبويبات
// JavaScript لتفعيل التبويبات
const tabButtons = document.querySelectorAll('.tab-button');
const tabPanes = document.querySelectorAll('.tab-pane');

tabButtons.forEach(button => {
  button.addEventListener('click', () => {
    // إزالة التفعيل عن جميع الأزرار
    tabButtons.forEach(btn => btn.classList.remove('active'));
    // إضافة التفعيل للزر الحالي
    button.classList.add('active');

    // إخفاء جميع محتويات التبويبات
    tabPanes.forEach(pane => pane.classList.remove('active'));
    // عرض المحتوى الخاص بالتبويب الحالي
    const tabId = button.getAttribute('data-tab');
    document.getElementById(tabId).classList.add('active');
  });
});

var modal = document.getElementById("myModal");
var deleteBtn = document.getElementById("deleteBtn");
var cancelBtn = document.getElementById("cancelBtn");

// عندما يضغط المستخدم على "Delete Portfolio" يتم فتح الموديل
deleteBtn.onclick = function() {
    modal.style.display = "block";
}

// عندما يضغط المستخدم على "Cancel" يتم إغلاق الموديل
cancelBtn.onclick = function() {
    modal.style.display = "none";
}

// إغلاق الموديل عند الضغط خارج الموديل
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}