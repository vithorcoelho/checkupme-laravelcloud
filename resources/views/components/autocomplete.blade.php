<div>
    <style>
        .autocomplete-container {
            position: relative;
            width: 300px;
        }
        .autocomplete-input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .autocomplete-list {
            position: absolute;
            width: 100%;
            border: 1px solid #ccc;
            background: white;
            max-height: 200px;
            overflow-y: auto;
            display: none;
            z-index: 1000;
        }
        .autocomplete-list div {
            padding: 8px;
            cursor: pointer;
        }
        .autocomplete-list div:hover {
            background: #f0f0f0;
        }
    </style>

    <div class="autocomplete-container">
        <input type="text" id="search" class="autocomplete-input" placeholder="Digite algo..." oninput="filterSuggestions()">
        <div id="autocomplete-list" class="autocomplete-list"></div>
    </div>
    
    <script>
        const suggestions = @json($data);
    
        function filterSuggestions() {
            const input = document.getElementById("search");
            const list = document.getElementById("autocomplete-list");
            const value = input.value.toLowerCase();
    
            list.innerHTML = "";
            if (!value) {
                list.style.display = "none";
                return;
            }
    
            const filtered = suggestions.filter(item => item.toLowerCase().includes(value));
            
            if (filtered.length === 0) {
                list.style.display = "none";
                return;
            }
    
            filtered.forEach(item => {
                const div = document.createElement("div");
                div.textContent = item;
                div.onclick = () => {
                    input.value = item;
                    list.style.display = "none";
                };
                list.appendChild(div);
            });
    
            list.style.display = "block";
        }
    
        document.addEventListener("click", (event) => {
            const container = document.querySelector(".autocomplete-container");
            if (!container.contains(event.target)) {
                document.getElementById("autocomplete-list").style.display = "none";
            }
        });
    </script>    
</div>
