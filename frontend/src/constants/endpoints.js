export const API_URL = "http://localhost:3000";

const ENDPOINTS = {
  LOGIN: `${API_URL}/user`,
  LOGOUT: `${API_URL}/auth/signout`,
  COMPANY_SETUP: `${API_URL}/auth/setup`,
};

export default ENDPOINTS;
