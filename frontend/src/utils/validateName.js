function validateName(name) {
  // If no name provided or only whitespace(s) provided
  if (!name || !name.trim()) throw new Error("Please provide a name.");

  //Test the name
  const nameRegex = /^[A-Za-z\s]+$/;
  const result = nameRegex.test(name);

  if (!result) throw new Error("Name have invalid characters.");
  return true;
}
