/**
 * Reads a picked image file into a data URL, downscaled so it is small enough
 * to live inside a saved report template.
 *
 * WebP keeps transparency, which matters for a signature scanned on white —
 * browsers that cannot encode it fall back to PNG on their own.
 *
 * @param {File} file
 * @param {{ maxWidth?: number, quality?: number }} options
 * @returns {Promise<string>} data URL
 */
export default function readImageFile(file, { maxWidth = 600, quality = 0.92 } = {}) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();

    reader.onerror = () => reject(reader.error);

    reader.onload = () => {
      const image = new Image();

      image.onerror = () => reject(new Error("Unsupported image file"));

      image.onload = () => {
        const scale = Math.min(1, maxWidth / image.naturalWidth);

        if (scale === 1) {
          resolve(reader.result);

          return;
        }

        const canvas = document.createElement("canvas");

        canvas.width = Math.round(image.naturalWidth * scale);
        canvas.height = Math.round(image.naturalHeight * scale);
        canvas
          .getContext("2d")
          .drawImage(image, 0, 0, canvas.width, canvas.height);

        resolve(canvas.toDataURL("image/webp", quality));
      };

      image.src = reader.result;
    };

    reader.readAsDataURL(file);
  });
}
