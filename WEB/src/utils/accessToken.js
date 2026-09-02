export const getAccessToken = () => {
  const token = localStorage.getItem("token");

  if (!token) return null;

  try {
    const item = JSON.parse(token);
    const now = new Date();

    if (now.getTime() > item.expiry) {
      localStorage.removeItem("token");
      return null;
    }

    return item.value;
  } catch (error) {
    // If parsing fails, the data is invalid/malformed
    console.error("Token format invalid, clearing storage.");
    localStorage.removeItem("token");
    return null;
  }
};

export const setAccessToken = (item) => {

  localStorage.setItem("token", JSON.stringify(item))
}

export const removeAccessToken = () => {
  localStorage.removeItem("token")
}