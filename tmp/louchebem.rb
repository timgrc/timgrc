def louchebem_word(word)
  suffix = ["em", "é", "ji", "oc", "ic", "uche", "ès"]
  letters = word.split("")
  first_vowel_index = letters.find_index { |letter| vowel?(letter) }

  # louchebem = "l" + letters[first_vowel_index...letters.size].join + letters[0...first_vowel_index].join + "em"
  louchebem = "l" + letters.rotate(first_vowel_index).join + suffix.sample

  louchebem.downcase
end

def vowel?(letter)
  vowels = ["a", "e", "i", "o", "u", "y"]
  return vowels.include? letter.downcase
end

p louchebem_word("Chaton")
p louchebem_word("Avion")
