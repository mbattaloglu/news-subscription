async function subscribe(name, email) {
  if (!name || !email) throw new Error("Please proivde user information");

  const formData = new FormData();
  formData.append("name", name);
  formData.append("email", email);

  const response = await fetch(
    "http://localhost/news-subscription/subscribe/",
    {
      body: formData,
      method: "POST",
    }
  );

  if (!response.ok) {
    throw new Error("Request cannot be sent. Please try again");
  }

  const data = await response.json();
  return data;
}
