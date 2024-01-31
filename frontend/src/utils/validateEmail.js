function validateEmail(email) {
  // If no email provided or only whitespace(s) provided
  if (!email || !email.trim()) throw new Error("Please provide a email.");

  const nonLatinRegex = /[^A-Za-z0-9@.%+-]/;
  if (nonLatinRegex.test(email))
    throw new Error("Email contains invalid characters.");

  //Test the email structure
  const emailStructureRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
  if (!emailStructureRegex.test(email)) throw new Error("Email is not valid.");

  return true;
}
