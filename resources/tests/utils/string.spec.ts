import { describe, expect, test } from '@jest/globals'
import * as string from '../../utils/string'

// scoped constants -->
let original: string = 'This is a sentence. A good one, at that!'
let modified: string
let expected: string

// test-suite -->
describe('Testing the string utility library', () => {
  // test -->
  test('A string should be truncated with an ellipsis (...) on the end of it', () => {
    expected = 'This is a sentence. A goo...'
    expect(string.truncate(original, 25)).toEqual(expected)
  })

  // test -->
  test('A hyphenated string will have the hyphens removed', () => {
    modified = 'this-is-a-sentence'
    expected = 'this is a sentence'
    expect(string.removeHyphens(modified)).toEqual(expected)
  })

  // test -->
  test('A string should be converted to a slug', () => {
    expected = 'this-is-a-sentence-a-good-one-at-that'
    expect(string.slugify(original)).toEqual(expected)
  })

  // test -->
  test('A string should be converted to title-case', () => {
    expected = 'This Is A Sentence. A Good One, At That!'
    expect(string.toTitleCase(original)).toEqual(expected)
  })

  // test -->
  test('A string should have the first letter converted to uppercase', () => {
    modified = 'this is a sentence. A good one, at that!'
    expected = 'This is a sentence. A good one, at that!'
    expect(string.ucFirst(modified)).toEqual(expected)
  })

  // test -->
  test('A string should be converted to plural form', () => {
    modified = 'Sentence'
    expected = 'Sentences'
    expect(string.plural(modified)).toEqual(expected)
  })

  // test -->
  test('A string should be converted to singular form', () => {
    modified = 'Sentences'
    expected = 'Sentence'
    expect(string.singular(modified)).toEqual(expected)
  })

  // test -->
  test('A string should be stripped of double quotes', () => {
    modified = '"Sentences"'
    expected = 'Sentences'
    expect(string.strip(modified)).toEqual(expected)
  })

  // test -->
  test('A string should be stripped of single quotes', () => {
    modified = "'Sentences'"
    expected = 'Sentences'
    expect(string.strip(modified)).toEqual(expected)
  })
})
