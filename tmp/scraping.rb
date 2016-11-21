require 'mechanize'
require 'open-uri'
require 'nokogiri'

agent = Mechanize.new
# url = "http://www.repertoire-eld.com/annuaire-V2/index.asp?page=annuaire_accueil"

scrap = []

(1..15).to_a.each do |index_page|
  url = "http://www.repertoire-eld.com/annuaire-V2/index.asp?inputAct=AnnActDel&IdxPage=#{index_page}"
  page = agent.get(url)
  page.search('.titre_entr').each_with_index do |element|
    scrap << element.css('a').text.tr('&nbsp', '')
  end
end

p scrap
p scrap.size
