$(document).ready(() => {
  // Handle form submit
  $("#search-form").on("submit", (event) => {
    event.preventDefault();

    const query = $("#search-input").val();

    search(query);
  });
});

async function search(query) {
  try {
    const response = await fetch(`https://api.example.com/search?q=${query}`);
    const results = await response.json();

    const resultsContainer = $("#results-container");
    resultsContainer.empty();

    results.forEach((result) => {
      const html = `
          <div class="result">
            <h2>${result.title}</h2>
            <p>${result.description}</p>
          </div>
        `;

      resultsContainer.append(html);
    });
  } catch (error) {
    console.error(error);
  }
}
