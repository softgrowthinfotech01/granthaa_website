export default {
    content: [
    "./*.php",
    "./**/*.php",
    "./**/*.html",
    "./**/*.js"
  ],
  safelist: [
  {
    pattern: /(from|to)-(orange|green|blue|yellow|indigo|purple)-(100|200|300|400|500|600|700|800|900)/
  },
  'bg-gradient-to-br'
],
  theme: {
    extend: {},
  },
  plugins: [],
}
