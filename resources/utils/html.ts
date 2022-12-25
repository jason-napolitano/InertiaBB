import DOMPurify from 'isomorphic-dompurify'

/**
 * Sanitize an HTML string for v-html
 *
 * @param {string} string
 *
 * @returns {string}
 */
export const sanitize = (string: string): string =>
  DOMPurify.sanitize(string, { USE_PROFILES: { html: true } })
